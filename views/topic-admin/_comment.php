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
<div class="comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('../comment/_form', [
        'model' => $model,
    ]) ?>

</div>
