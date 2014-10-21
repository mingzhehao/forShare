<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                //'options' => ['class' => 'form-horizontal'],
                //'fieldConfig' => [
                //    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                //    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                //],
            ]); ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

            <?= $form->field($model, 'rememberMe', [
                //'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ])->checkbox() ?>



            <div class="form-group">
                <!-- <div class="col-lg-offset-1 col-lg-11"> -->
                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <!-- </div> -->
            </div>

            <?php ActiveForm::end(); ?>

            <div  style="color:#999;">
                You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
                To modify the username/password, please check out the code <code>app\models\User::$users</code>.
            </div>

        </div>

        <div class="col-lg-5 pull-right">
            <div class="auth-clients" id="w0">
                <ul class="auth-clients clear"><li class="auth-client"><a href="/auth?authclient=qq" class="auth-link qq"><span class="auth-icon qq"></span><span class="auth-title">QQ登录</span></a></li><li class="auth-client"><a href="/auth?authclient=wb" class="auth-link wb"><span class="auth-icon wb"></span><span class="auth-title">微博登录</span></a></li>
                </ul>
            </div>            
                没有帐号？ <a href="/site/signup">注册新会员</a>            
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
