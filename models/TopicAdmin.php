<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\BaseModel;
use app\models\Tag;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "topic".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $describe
 * @property string $tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 * @property integer $viewcount
 * @property integer $up
 * @property integer $collect
 * @property integer $classify
 */
class TopicAdmin extends BaseModel
{
    private $_oldTags;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topic';
    }

    public static function getClassName()
    {
        return 'topic';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'describe', 'status', 'classify'], 'required'],
            [['content', 'tags'], 'string'],
            [['status', 'classify'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['describe'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'describe' => '描述',
            'tags' => '标签',
            'status' => '状态',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'author_id' => '作者ID',
            'viewcount' => '查阅次数',
            'up' => '点赞',
            'collect' => '收藏',
            'classify' => '分类',
        ];
    }
 
    /**
     * This is invoked when a record is populated with data from a find() call.
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTags=$this->tags;
    }

/**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $this->create_time=time();
                $this->author_id=Yii::$app->user->id;
            }
            return true;
        }
        else
            return false;
    }

    /**
     * This is invoked after the record is saved.
     */
    public function afterSave()
    {
        parent::afterSave();
        Tag::updateFrequency($this->_oldTags, $this->tags,strtolower($this->getClassName()));
    }

    /**
     * This is invoked after the record is deleted.
     */
    public function afterDelete()
    {
        parent::afterDelete();
        Comment::deleteAll(['post_id'=>$this->id,'classify_type'=>strtolower($this->getClassName())]);
        Tag::updateFrequency($this->tags, '',strtolower($this->getClassName()));
    }
   

    /**
     * Adds a new comment to this news.
     * This method will set status and http_news_fields(url, data) of the comment accordingly.
     * @param Comment the comment to be added
     * @return boolean whether the comment is saved successfully
     */
    public function addComment($comment)
    {
        if(Yii::$app->params['commentNeedApproval'])
            $comment->status=Comment::STATUS_PENDING;
        else
            $comment->status=Comment::STATUS_APPROVED;
        $comment->post_id=$this->id;
        return $comment->save();
    }


    /*
     *  获取所有内容，存在分类标识输出其相关内容 
     */
    public function getClassify($params=null)
    {
        if(empty($params['classify']))
        {
            $connection = Yii::$app->db;
            $command = $connection->createCommand('SELECT classify,count(classify) as counts FROM '.self::tableName().' group by classify ');
            $postCount = $command->queryAll();
        }
        else
        {
            $connection = Yii::$app->db;
            $command = $connection->createCommand('SELECT classify,count(classify) as counts FROM '.self::tableName().' where classify = "'.$params['classify'].'" group by classify ');
            $postCount = $command->queryAll();
        }
        return $postCount;
    }


    /**
     * @param integer the maximum number of comments that should be returned
     * @return array the most recently added comments
     */
    public function getHotPosts($limit=10)
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand('SELECT * FROM '.self::tableName().' order by viewcount desc limit 10');
        $postCount = $command->queryAll();
        return $postCount;
    }

    /*
     * 获取当前文章url
     */
    public function getUrl()
    {
        /*
            页面中如下进行输出
            <?= Html::encode($model->url) ?>
        */
        return Yii::$app->urlManager->createUrl(['topic-admin/view', 'id' => $this->id,'title' => $this->title]);
    }


    /**
     * 关联数据 获取当前文章所属用户的username
     */
    public function getUname()
    {
        // 关联的一对一关系
        // select * from user where id = author_id;
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /*
     * 关联数据 获取当前文章评论总数
     */
    public function getComment()
    {
        return $this->hasMany(Comment::className(),['post_id' => 'id']);
    }  

}
