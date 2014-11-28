<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TopicAdmin;

/**
 * TopicAdminSearch represents the model behind the search form about `app\models\TopicAdmin`.
 */
class TopicAdminSearch extends TopicAdmin
{
    public function rules()
    {
        return [
            [['id', 'status', 'create_time', 'update_time', 'author_id', 'viewcount', 'up', 'classify'], 'integer'],
            [['title', 'content', 'describe', 'tags','tag'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = TopicAdmin::find();
        $queryParams = Yii::$app->request->getQueryParams();
        $sort = mysql_escape_string(isset($queryParams['sort'])?$queryParams['sort']:'update_time');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ["$sort"=>SORT_DESC]],
            //'sort'=> ['defaultOrder' => ["update_time"=>SORT_DESC]],
            //'sort'  => [
            //    'attributes' => [
            //            'classify'=>SORT_DESC,
            //    ]
            //],
        ]);
        /*自定义处理classify存在情况下的搜索*/
        if(isset($params['classify']) && !empty($params['classify']))
        {
            $this->classify = mysql_escape_string(trim($params['classify']));
        }
        elseif(isset($params['tag']) &&!empty($params['tag']))
        {
            $this->tags=mysql_escape_string(trim($params['tag']));
        }
        else
        {
            if (!($this->load($params) && $this->validate())) {
                return $dataProvider;
            }
        }   
        /*********END*************************/

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'author_id' => $this->author_id,
            'viewcount' => $this->viewcount,
            'up' => $this->up,
            'classify' => $this->classify,
        ]);
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'describe', $this->describe])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        return $dataProvider;
    }
}
