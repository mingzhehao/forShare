<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\markdown\MarkdownEditor;

/**
 * @var yii\web\View $this
 * @var app\models\TopicAdmin $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="topic-admin-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'classify')->textInput()->dropDownList($model->topicClassify()) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

    <?php
         echo $form->field($model, 'content')->widget(
            MarkdownEditor::classname(), 
            ['height' => 300, 'encodeLabels' => false]
        );
    ?>

    <?= $form->field($model, 'describe')->textInput(['maxlength' => 1024]) ?>

    <?= $form->field($model, 'status')->textInput()->dropDownList($model->getList())  //['prompt'=>'Choose...']) ?>

    <?= $form->field($model, 'tags')->textInput() ?>
    <div class="hint-block">特别注意：多个标签请用 <font color="red"><strong>半角逗号</strong></font> 分隔。</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
