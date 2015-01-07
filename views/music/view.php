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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'describe',
            'tags',
            'status',
            'create_time:datetime',
            'update_time:datetime',
            'author_id',
            'viewcount',
            'up',
            'classify',
        ],
    ]) ?>

    <?php
        // default call
        echo Markdown::convert($model->content);

        // with custom post processing
        echo Markdown::convert($model->content, ['custom' => [
                    '<h1>' => '<h1 class="custom-h1>',
                        '<h2>' => '<h1 class="custom-h2>',
                        ]]);

    ?>
</div>
