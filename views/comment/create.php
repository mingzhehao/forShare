<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Comment $model
 */

$this->title = Yii::t('app', '回复主题', [
  'modelClass' => 'Comment',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '评论管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
