<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\CommentSearch $searchModel
 */

$this->title = Yii::t('app', '评论管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '创建评论', [
  'modelClass' => 'Comment',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'content:ntext',
            [
                'attribute' => 'status',
                'label'     => '评论状态',
                'value'     => function ($data) {
                    if(!empty($data->status))
                        return '审核通过';
                    else
                        return '等待审核';
                },
                'filter'    => [
                        0 => '等待审核',//key 0  为传递到后台搜索值，值为对外显示值
                        1 => '审核通过',
                   ],
            ],
            //'author_id',
            'author_name',
            //['attribute' => 'post_id', 'value' => 'post_id'],
            [
                'attribute' => 'post_id',
                'label' => '文章ID',
                //'value' => 'post_id',
                'filter' => yii\helpers\ArrayHelper::map(app\models\Comment::find()->orderBy('id')->asArray()->all(),'post_id','post_id')//第一个post_id 是检索时对外传递值，第二个post_id是对外展示值
            ],
            // 'comment_parent_id',
            // 'create_time',
            // 'post_id',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
