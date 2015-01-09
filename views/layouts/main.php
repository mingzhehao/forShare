<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                //'brandLabel' => 'YIIFRAME',
                'brandLabel' => '<img src="/images/logo.png" alt="">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [ 
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => '首页', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
                $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
            } else {
                //$menuItems[] = ['label' => 'CRUD管理', 'url' => ['/admin/view']];
                //$menuItems[] = ['label' => '分类管理', 'url' => ['/classify/index']];
                $menuItems[] = ['label' => '用户管理', 'url' => ['/admin/index']];
                $menuItems[] = ['label' => '音乐欣赏', 'url' => ['/music/index']];
                $menuItems[] = ['label' => '分享趣事', 'url' => ['/humour/index']];
                $menuItems[] = ['label' => '话题讨论', 'url' => ['/topic-admin/index']];
                $menuItems[] = [
                    'label' => '退出 (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => $menuItems,
            ]); 
            echo '<form class="navbar-form navbar-left" action="/search" method="post" style="width:300px;">
                     <input type="hidden" name="_csrf" value="'.Yii::$app->request->getCsrfToken().'">
                     <div class="input-group">
                         <input type="text" class="form-control" name="q" placeholder="全站搜索">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                         </span>
                     </div>
                     </form>';
            if(!Yii::$app->user->isGuest)
            {
                echo '<ul id="w5" class="navbar-nav navbar-right nav">
                        <li><a href="/User/notice"><span class="glyphicon glyphicon-envelope"></span> </a></li>
                        <li class="dropdown"><a class="avatar dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><img src="/images/noavatar_small.gif" width="30" alt=""> <b class="caret"></b></a>
                            <ul id="w6" class="dropdown-menu"><li><a href="/User/home" tabindex="-1"><span class="glyphicon glyphicon-user"></span> 个人主页</a></li>
                            <li><a href="/User/setting" tabindex="-1"><span class="glyphicon glyphicon-cog"></span> 帐户设置</a></li>
                            <li><a href="/User/favourite" tabindex="-1"><span class="glyphicon glyphicon-star"></span> 我的收藏</a></li>
                            <li><a href="/top" tabindex="-1"><span class="glyphicon glyphicon-stats"></span> 排行榜</a></li>
                            <li class="divider"></li>
                            <li><a href="/site/logout" data-method="post" tabindex="-1"><span class="glyphicon glyphicon-log-out"></span> 退出</a></li>
                            </ul>
                        </li>
                    </ul>';
            }
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
