<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/****此页面输出上级页面传递的dataProvider 通过$model输出***/


/**
 * @var yii\web\View $this
 * @var app\models\Comment $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<li class="media" data-key="282">
    <a class="pull-left" href="/user/28972" data-original-title="" title="">
        <img class="media-object" src="/images/noavatar_small.gif" alt="">
    </a>
    <div class="pull-right">
        <a class="views" href="/question/282">浏览<em>207</em></a>
        <a class="answers" href="/question/282">回答<em>1</em></a>
    </div>
    <div class="media-body">
        <h2 class="media-heading">
            <span class="glyphicon glyphicon-question-sign"></span> 
            <a href="/topic-admin/view?id=<?php echo $model->id; ?>"><?= Html::encode("$model->title");?></a>
            <small>[ 悬赏分：0 ]</small>
        </h2>
        <div class="media-action">
            <a href="/user/28972">起风了</a> 发布于 2天前<span class="dot"> • </span>
            <a href="/user/740">hanlicun</a> 最后回答于 1天前<span class="dot"> • </span>
            <span class="glyphicon glyphicon-star"></span> 0<span class="dot"> • </span>
            <span class="glyphicon glyphicon-thumbs-up"></span> 0
        </div>
    </div>
</li>
