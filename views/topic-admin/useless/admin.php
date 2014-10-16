<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\TopicAdminSearch $searchModel
 */

$this->title = '话题管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topic-admin-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建话题', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            //'content:ntext',
            'describe',
            'tags:ntext',
            'status',
            'create_time:datetime',
            //'update_time:datetime',
            'author_id',
            // 'viewcount',
            // 'up',
             'classify',

            ['class' => 'yii\grid\ActionColumn'],
            //['class' => 'yii\grid\DataColumn','attribute'=>'classify'],
            ['class' => 'yii\grid\CheckboxColumn'],
        ],
    ]); ?>



<?php
echo ListView::widget([//'template' => 'Header News', 
    'dataProvider' => $dataProvider,
    'itemView' => '_listItem',
    'layout' => '{items}{pager}',
    'itemOptions' => ['class' => 'item'],
    'options' => [
        'links' => '<h2>test</h2>',
        'tag' => 'ul',
        'class' => 'ten-vertical summary-list',

    ],

    'viewParams' => array(
        'categoryAlias' => '123',
        'imageConfig' => array('width' => 120, 'height' => 120, 'fill' => true),
        'firstImageConfig' => array('width' => 436, 'height' => 436, 'fill' => true),
    ),
]);
?>


</div>
