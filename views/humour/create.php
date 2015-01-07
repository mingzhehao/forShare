<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\TopicAdmin $model
 */

$this->title = '话题创建';
$this->params['breadcrumbs'][] = ['label' => '话题管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topic-admin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
