<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Comment $model
 */

$this->title = Yii::t('app', '回复主题', [
  'modelClass' => 'Comment',
]);
?>

    <li class="media" data-key="37182">
        <a class="pull-left" href="/user/<?php echo $model->author_id; ?>" data-original-title="" title="">
            <img class="media-object" src="/images/noavatar_small.gif" alt="">
        </a>
        <div class="media-body">
            <div class="media-heading">
                <a href="/user/<?php echo $model->author_id; ?>"><?php echo $model->author_name; ?></a> 发布于 5小时前<span class="pull-right"><a>举报</a>
            </div>
            <div class="media-content">
                <p><?php echo $model->content; ?> </p>
            </div>
            <div class="media-action">
                <a class="reply-btn" href="#">回复</a> | <a class="quote-btn" href="#reply">引用此评论</a>
            </div>
        </div>
    </li>

