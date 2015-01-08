<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\markdown\MarkdownEditor;
use xj\ueditor\Ueditor;

/**
 * @var yii\web\View $this
 * @var app\models\TopicAdmin $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="topic-admin-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'classify')->textInput()->dropDownList($model->musicClassify()) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

    <?php
       //  echo $form->field($model, 'content')->widget(
       //     MarkdownEditor::classname(), 
       //     ['height' => 300, 'encodeLabels' => false]
       // );
    ?>

    <?php
         echo $form->field($model, 'content')->widget(
            Ueditor::classname(), 
            [
                /**
                  * important:注意
                  * attribute name value 如果开启会影响数据，不开启获取的才是$model的属性以及数据.
                  */
                //'attribute' => 'content',
                //'name' => 'content',
                //'value' => '',
                'style' => 'width:100%;height:400px',
                'renderTag' => true,
                //'readyEvent' => 'console.log("example2 ready")',
                'jsOptions' => [
                    'serverUrl' => yii\helpers\Url::to(['upload']),
                    'autoHeightEnable' => true,
                    'autoFloatEnable' => true
                    ],
                
            ]
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
