<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\markdown\Markdown;

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

    <div class="action">
        <span class="user"><a href="/user/28698"><span class="glyphicon glyphicon-user"></span><?= Html::encode($model->uname->username) ?></a></span>
        <span class="time"><span class="glyphicon glyphicon-time"></span> <?= Html::encode($model->update_time) ?></span>
        <span class="views"><span class="glyphicon glyphicon-eye-open"></span> <?= Html::encode($model->viewcount) ?>次浏览</span>
        <span class="replies"><a href="#replies"><span class="glyphicon glyphicon-comment"></span><?= Html::encode($model->uname->username) ?>条回复</a></span>
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


    <div id="replies">
        <div class="page-header">
            <h2>
                共 <em>1</em> 条回复
                <ul id="w0" class="nav nav-tabs">
                    <li class="active"><a href="/topic/5558#replies">默认排序</a></li>
                    <li><a href="/topic/5558?sort=desc#replies">最后回复</a></li></ul>                
            </h2>
        </div>

        <ul id="w1" class="media-list">
            <li class="media" data-key="37182">
                <a class="pull-left" href="/user/5701" data-original-title="" title="">
                    <img class="media-object" src="/images/noavatar_small.gif" alt="">
                </a>
                <div class="media-body">
                    <div class="media-heading">
                        <a href="/user/5701">akingsky</a> 发布于 5小时前<span class="pull-right"><a>举报</a>
                    </div>
                    <div class="media-content">
                        <p>有啊  在common里面啊 很多东西要和前台共用的啊 </p>
                    </div>
                    <div class="media-action">
                        <a class="reply-btn" href="#">回复</a> | <a class="quote-btn" href="#reply">引用此评论</a>
                    </div>
                </div>
            </li>
        </ul>        
    </div>
    

    <?php //echo $this->render('../comment/create',['model' => $model,]); ?>
    <?php echo $this->render('_comment',['model' => $model,]); ?>

</div>
