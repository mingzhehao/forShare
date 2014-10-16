<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\markdown\MarkdownEditor;

/**
 * @var yii\web\View $this
 * @var app\models\Comment $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<?php if(Yii::$app->user->isGuest)
{
?>

<div id="answer">
    <div class="page-header">
        <h2>回答问题</h2>
    </div>
    <div class="well danger">您需要登录后才可以回答。<a href="/login">登录</a> | <a href="/signup">立即注册</a></div>
</div>

<?php
}
else
{
?>

<div class="comment-form" id="reply">

    <?php $form = ActiveForm::begin(); ?>

    <?php
         echo $form->field($model, 'content')->widget(
            MarkdownEditor::classname(), 
            ['height' => 300, 'encodeLabels' => false]
        );
    ?>
    <div class="hint-block">特别注意：多个标签请用 <font color="red"><strong>半角逗号</strong></font> 分隔。</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '回复') : Yii::t('app', '更新 '), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
}
?>
