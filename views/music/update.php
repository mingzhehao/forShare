<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\TopicAdmin $model
 */

$this->title = '更新话题: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '话题管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="topic-admin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
