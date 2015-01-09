<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Admin $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => 255,'value'=>'']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?php if(Yii::$app->user->getIdentity()->role == '1'){ ?>
        <?= $form->field($model, 'role')->textInput()->dropDownList(['1'=>'管理员','10'=>"会员"]) ?>
        <?= $form->field($model, 'status')->textInput()->dropDownList(['10'=>'活跃',"0"=>'封禁']) ?>
    <?php } else{ ?>
        <?= $form->field($model, 'role')->textInput()->dropDownList(['10'=>"会员"]) ?>
        <?= $form->field($model, 'status')->textInput()->dropDownList(['10'=>'活跃',"0"=>'封禁']) ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
