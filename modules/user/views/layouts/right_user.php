<?php
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \yii\gii\Generator[] $generators
 * @var \yii\gii\Generator $activeGenerator
 * @var string $content
 */
//$activeGenerator = Yii::$app->controller->generator;
$activeGenerator = isset($_GET['id'])?$_GET['id']:'1';

?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<?php //$this->beginContent('@app/views/layouts/main.php'); ?>
<style type="text/css">
.list-group .glyphicon {
        float: right;
}
</style>
<div class="row">
    <div class="col-lg-3 sidebar">
        <div class="well">
            <div class="media">
                <div class="pull-left">
                    <img class="media-object" src="/images/noavatar_middle.gif" alt="" style="width: 100px; height: 100px;">
                </div>                
                <div class="media-body">
                    <h2>yiiframework</h2>
                    <span class="glyphicon glyphicon-home"></span> <a href="/user/28893">个人主页</a><br>
                    <span class="glyphicon glyphicon-cog"></span> <a href="/user/site/index">帐户设置</a><br>
                    <span class="glyphicon glyphicon-camera"></span> <a href="/user/site/avatar">修改头像</a>                                    </div>
            </div>
            <div class="media-footer">
                <a href="/user/28893/follow">关注(0)</a>                <em>|</em> 
                <a href="/user/28893/fans">粉丝(0)</a>                <em>|</em>
                <a href="/rule">积分(80)</a>            
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">关注<span class="pull-right"><a href="/user/28893/follow">全部关注</a></span></div>
            <div class="panel-body">
                <ul class="avatar-list">
                </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">粉丝<span class="pull-right"><a href="/user/28893/fans">全部粉丝</a></span></div>
            <div class="panel-body">
                <ul class="avatar-list">
                                    </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">最近访客<span class="pull-right"><a href="/user/28893/visit">全部访客</a></span></div>
            <div class="panel-body">
                <ul class="media-list">
                                    </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9 col-sm-8">
        <?= $content ?>
    </div>
</div>
    <?php $this->endContent(); ?>

