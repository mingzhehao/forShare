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
$sort = $_GET['sort'];
?>
<div class="topic-admin-index">

    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="page-header">
        <h1>
            话题
            <ul id="w0" class="nav nav-tabs">
                <li <?php if(empty($sort)) echo 'class="active"'; ?> ><a href="/topic-admin/index">最新发布</a></li>
                <li <?php if($sort=='view') echo 'class="active"'; ?> ><a href="/topic-admin/index?sort=view">最多查看</a></li>
                <li <?php if($sort=='up') echo 'class="active"'; ?> ><a href="/topic-admin/index?sort=up">最多点赞</a></li>
                <li <?php if($sort=='score') echo 'class="active"'; ?>><a href="/topic-admin/index?sort=score">最高评分</a></li>
            </ul>            
        </h1>
    </div>


        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_listItem',
            'layout' => '{items}{pager}',
            'itemOptions' => ['class' => 'media-list'],
            'options' => [
                'tag' => 'div',
                'class' => 'ten-vertical summary-list',
        ],

        //'viewParams' => array(
        //    'categoryAlias' => '123',
        //    'imageConfig' => array('width' => 120, 'height' => 120, 'fill' => true),
        //    'firstImageConfig' => array('width' => 436, 'height' => 436, 'fill' => true),
        //),
    ]);
    ?>


</div>
