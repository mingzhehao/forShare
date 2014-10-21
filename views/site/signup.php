<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \frontend\models\SignupForm $model
 */
$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-lg-5 pull-right">
            <div class="auth-clients" id="w0">
                <ul class="auth-clients clear">
                    <li class="auth-client"><a href="/auth?authclient=qq" class="auth-link qq"><span class="auth-icon qq"></span><span class="auth-title">QQ登录</span></a></li><li class="auth-client"><a href="/auth?authclient=wb" class="auth-link wb"><span class="auth-icon wb"></span><span class="auth-title">微博登录</span></a></li>
                </ul>
            </div>      
            已有帐号？ <a href="/site/login">点此登录</a>           
            <h2>登录后可以？</h2>
            <ol>
                <li>分享您的教程，扩展，源码</li>
                <li>参与问题和帖子的讨论，回复和评分</li>
                <li>收藏具有价值的教程和帖子</li>
                <li>发布招聘信息、找工作</li>
            </ol>
        </div>

    </div>
</div>
