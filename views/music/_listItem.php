<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/****此页面输出上级页面传递的dataProvider 通过$model输出***/


/**
 * @var yii\web\View $this
 * @var app\models\Comment $model
 * @var yii\widgets\ActiveForm $form
 */
$userImage = explode('.',$model->uname->file);
$userMiddleImage = $userImage['0'].'_small.'.$userImage['1'];
?>
<li class="media" data-key="282">
    <a class="pull-left" href="/User/<?php echo $model->author_id;?>" data-original-title="" title="">
        <img class="media-object" src="/<?php echo $userMiddleImage;?>" alt="">
    </a>
    <div class="pull-right">
        <a class="views" href="/music/view?id=<?php echo $model->id; ?>">浏览<em><?php echo $model->viewcount;?></em></a>
        <a class="answers" href="/question/282">回答<em>1</em></a>
    </div>
    <div class="media-body">
        <h2 class="media-heading">
            <span class="glyphicon glyphicon-question-sign"></span> 
            <a href="/music/view?id=<?php echo $model->id; ?>"><?= Html::encode("$model->title");?></a>
            <small>[ 悬赏分：0 ]</small>
        </h2>
        <div class="media-action">
            <a href="/User/<?php echo $model->author_id;?>"><?= Html::encode($model->uname->username) ?></a> 发布于 <?php echo $model->create_time; ?><span class="dot"> • </span>
            <a href="/user/740">hanlicun</a> 最后回答于 1天前<span class="dot"> • </span>
            <span class="glyphicon glyphicon-star"></span> 0<span class="dot"> • </span>
            <span class="glyphicon glyphicon-thumbs-up"></span> <?php echo $model->up;?>
        </div>
    </div>
</li>
