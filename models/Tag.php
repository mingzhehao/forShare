<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name','classify'], 'string', 'max' => 128]
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'name' => 'Name',
            'frequency' => 'Frequency',
        );
    }

    /**
     * Returns tag names and their corresponding weights.
     * Only the tags with the top weights will be returned.
     * @param integer the maximum number of tags that should be returned
     * @return array weights indexed by tag names.
     */
    public function findTagWeights($limit=20)
    {
        $models=$this->findAll(array(
            'order'=>'frequency DESC',
            'limit'=>$limit,
        ));

        $total=0;
        foreach($models as $model)
            $total+=$model->frequency;

        $tags=array();
        if($total>0)
        {
            foreach($models as $model)
                $tags[$model->name]=8+(int)(16*$model->frequency/($total+10));
            ksort($tags);
        }
        return $tags;
    }

    /**
     * Suggests a list of existing tags matching the specified keyword.
     * @param string the keyword to be matched
     * @param integer maximum number of tags to be returned
     * @return array list of matching tag names
     */
    public function suggestTags($keyword,$limit=20)
    {
        $tags=$this->findAll(array(
            'condition'=>'name LIKE :keyword',
            'order'=>'frequency DESC, Name',
            'limit'=>$limit,
            'params'=>array(
                ':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
            ),
        ));
        $names=array();
        foreach($tags as $tag)
            $names[]=$tag->name;
        return $names;
    }

    public static function string2array($tags)
    {
        return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($tags)
    {
        return implode(', ',$tags);
    }


    /*
    * oldTags 原标签 string 
    * newTags 新标签 string 
    * classify_type 所属分类类型 string 
    */
    public function updateFrequency($oldTags, $newTags,$classify_type)
    {
        $oldTags=self::string2array($oldTags);
        $newTags=self::string2array($newTags);
        self::addTags(array_values(array_diff($newTags,$oldTags)),$classify_type);
        self::removeTags(array_values(array_diff($oldTags,$newTags)),$classify_type);
    }

    public function addTags($tags,$classify_type)
    {
        $criteria=new CDbCriteria;
        echo "AAA";exit;
        $criteria->addInCondition('name',$tags);
        $this->updateCounters(array('frequency'=>1),$criteria);
        foreach($tags as $name)
        {
            if(!$this->exists('name=:name',array(':name'=>$name)))
            {
                $tag=new Tag;
                $tag->name=$name;
                $tag->frequency=1;
                $tag->classify_type=$classify_type;
                $tag->save();
            }
        }
    }

    public function removeTags($tags,$classify_type)
    {
        if(empty($tags))
            return;
        $criteria=new CDbCriteria;
        $criteria->addInCondition('name',$tags);
        $this->updateCounters(array('frequency'=>-1),$criteria);
        $this->deleteAll('frequency<=0');
    }

}
