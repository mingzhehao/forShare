<?php
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;

$form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); //important
echo FileInput::widget([
                    'name' => 'filename',
                    'showUpload' => false,
                    'buttonOptions' => ['label' => false],
                    'removeOptions' => ['label' => false],
                    'groupOptions' => ['class' => 'input-group-lg']
                ]);
echo Html::submitButton('Submit', ['class'=>'btn btn-primary']);
ActiveForm::end();
