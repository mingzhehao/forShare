<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\markdown\Markdown;
use yii\widgets\ListView;

/**
 * @var yii\web\View $this
 * @var app\models\TopicAdmin $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '话题管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topic-admin-view">

    <h1><?= Html::encode($this->title) ?> <small><?= Html::encode($model->classify) ?></small></h1>
    <?php if(Yii::$app->user->getIdentity()->role === 1) { ?>
    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php } ?>
    <div class="action">
        <span class="user"><a href="/user/28698"><span class="glyphicon glyphicon-user"></span><?= Html::encode($model->uname->username) ?></a></span>
        <span class="time"><span class="glyphicon glyphicon-time"></span> <?= Html::encode($model->update_time) ?></span>
        <span class="views"><span class="glyphicon glyphicon-eye-open"></span> <?= Html::encode($model->viewcount) ?>次浏览</span>
        <span class="replies"><a href="#replies"><span class="glyphicon glyphicon-comment"></span> <?= Html::encode($dataProvider->totalCount); ?>条回复</a></span>
        <span class="favourites"><a class="favourite" href="/favourite?type=topic&amp;id=5539" title="" data-toggle="tooltip" data-original-title="收藏"><span class="glyphicon glyphicon-star-empty"></span> <em><?= Html::encode($model->viewcount) ?></em></a></span>
        <span class="vote"><a class="up" href="/vote?type=topic&amp;action=up&amp;id=5539" title="" data-toggle="tooltip" data-original-title="顶"><span class="glyphicon glyphicon-thumbs-up"></span> <em>0</em></a><a class="down" href="/vote?type=topic&amp;action=down&amp;id=5539" title="" data-toggle="tooltip" data-original-title="踩"><span class="glyphicon glyphicon-thumbs-down"></span> <em>0</em></a></span>
    </div>


    <?php
        // default call
        echo Markdown::convert($model->content);
        /*清空content显示*/
        $model->content=null ;
    ?>
    <div class="action" ></div>



<?php
#//Widget直接渲染Tag
#echo \xj\ueditor\Ueditor::widget([
#    'model' => $model->content,
#    'attribute' => 'password',
#    'name' => 'customName',
#    'value' => 'content',
#    'style' => 'width:100%;height:400px',
#    'renderTag' => true,
#    'readyEvent' => 'console.log("example2 ready")',
#    'jsOptions' => [
#        'serverUrl' => yii\helpers\Url::to(['upload']),
#        'autoHeightEnable' => true,
#        'autoFloatEnable' => true
#    ],
#]);
?>



    <div id="replies">
        <div class="page-header">
            <h2>
                共 <em><?php echo $dataProvider->totalCount;?></em> 条回复
                <ul id="w0" class="nav nav-tabs">
                    <li class="active"><a href="/topic/5558#replies">默认排序</a></li>
                    <li><a href="/topic/5558?sort=desc#replies">最后回复</a></li></ul>                
            </h2>
        </div>

        <ul id="w1" class="media-list">
        <?php
        echo ListView::widget([                                 
            'dataProvider' => $dataProvider,                    
            'itemView' => '_comment',                           
            'layout' => '{items}{pager}',                       
            'itemOptions' => ['class' => 'media-list'],         
            'options' => [                                      
                'tag' => 'div',                                 
                'class' => 'ten-vertical summary-list',         
        ],]);
        ?>
        </ul>

    </div>

    <?php if(Yii::$app->Session->hasFlash('commentSubmitted')){ ?>
        <div class="alert alert-danger" role="alert">
            <?php echo Yii::$app->Session->getFlash('commentSubmitted'); ?>
        </div>
    <?php } ?>


    <?php //echo $this->render('../comment/create',['model' => $model,]); ?>
    <?php echo $this->render('/comment/_form',['model' => $comment,]); ?>

</div>
