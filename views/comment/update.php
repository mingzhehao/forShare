<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Comment $model
 */

$this->title = Yii::t('app', '更新 {modelClass}: ', [
  'modelClass' => 'Comment',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '评论管理'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', '更新');
?>
<div class="comment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
