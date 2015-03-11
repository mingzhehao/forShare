<?php

use yii\helpers\Html;
use common\models\User;

/**
 * @var yii\web\View $this
 * @var app\models\Comment $model
 */

$this->title = Yii::t('app', '回复主题', [
  'modelClass' => 'Comment',
]);
$userImage = explode('.',User::findIdentity($model->author_id)->file);
$userSmallImage = $userImage['0'].'_small.'.$userImage['1'];
?>

    <li class="media" data-key="37182">
        <a class="pull-left" href="/User/<?php echo $model->author_id; ?>" data-original-title="" title="">
            <img class="media-object" src="/<?php echo $userSmallImage;?>" alt="">
        </a>
        <div class="media-body">
            <div class="media-heading">
                <a href="/User/<?php echo $model->author_id; ?>"><?php echo $model->author_name; ?></a> 发布于 <?php echo $model->create_time; ?><span class="pull-right"><a>举报</a>
            </div>
            <div class="media-content">
                <p><?php echo $model->content; ?> </p>
            </div>
            <div class="media-action">
                <a class="reply-btn" href="#">回复</a> | <a class="quote-btn" href="#reply">引用此评论</a>
            </div>
        </div>
    </li>

