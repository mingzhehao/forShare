<?php
use yii\helpers\Html;
use app\models\Music;
use app\models\Tag;

/**
 * @var \yii\web\View $this
 * @var \yii\gii\Generator[] $generators
 * @var \yii\gii\Generator $activeGenerator
 * @var string $content
 */
//$activeGenerator = Yii::$app->controller->generator;
$activeGenerator = isset($_GET['id'])?$_GET['id']:'1';

/***分类总数****/
$category = Yii::$app->controller->category(); 
/**分类名称获取 继承自BaseModel**/
$musicClassify = Music::musicClassify();
/*热门文章*/
$hotPosts = Music::getHotPosts();
/*热门标签*/
$tags =Tag::findTagWeights(20,'music');

?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<?php //$this->beginContent('@app/views/layouts/main.php'); ?>
<style type="text/css">
.list-group .glyphicon {
        float: right;
}
</style>
<div class="row">
    <div class="col-md-9 col-sm-8">
        <?= $content ?>
    </div>

    <div class="col-md-3 col-sm-4">
    <?php if(Yii::$app->user->getIdentity()->role === 1 && isset($_GET['id'])) { ?>
    <p>
        <?= Html::a('更新', ['update', 'id' => $_GET['id']], ['class' => 'btn btn-primary btn-lg btn-block']) ?>
        <?= Html::a('删除', ['delete', 'id' => $_GET['id']], [
            'class' => 'btn btn-danger btn-lg btn-block',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php } ?>

        <a class="btn btn-success btn-lg btn-block" href="/music/create"><span class="glyphicon glyphicon-plus"></span> 发布主题</a>
        <?php
            /***片段缓存----分类****/
            if ($this->beginCache('music-classify', ['duration' => 3600])) {
                $echo = '<div id="w2" class="list-group"><a class="list-group-item active" href="/music"><span class="badge">{totalnum}</span>全部主题</a>';
                $totalnum = 0;
                foreach ($category as $key => $val)
                {
                    $echo .= '<a class="list-group-item" href="/music/index?classify='.$val['classify'].'"><span class="badge">'.$val['counts'].'</span>'.$musicClassify[$val["classify"]].'</a>';
                    $totalnum += $val['counts'];
                } 
                $echo = str_replace('{totalnum}',$totalnum,$echo);
                echo $echo;
                $this->endCache();
            }
        ?>
                <a class="list-group-item" href="/music?category=1"><span class="badge">2510</span>新手入门</a>
                <a class="list-group-item" href="/music?category=2"><span class="badge">30</span>求助交流</a>
                <a class="list-group-item" href="/music?category=3"><span class="badge">66</span>技术分享</a>
                <a class="list-group-item" href="/music?category=4"><span class="badge">9</span>站务公告</a>
                <a class="list-group-item" href="/music?category=5"><span class="badge">29</span>求职招聘</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">热门主题</div>
                <div class="panel-body">
                    <ul class="list">
                    <?php 
                        if ($this->beginCache('music-hotposts', ['duration' => 3600])) {
                            $echo = '';
                            foreach($hotPosts as $key => $val)
                            {   
                                $echo .= '<li><a href="/music/view?id='.$val[id].'" title="" data-toggle="tooltip" data-original-title="'.$val[title].'">'.$val[title].'</a></li>';
                            }
                            echo $echo;
                            $this->endCache();
                        }
                    ?>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">热门标签</div>
                <div class="panel-body">
                    <ul class="tag-list">
                    <?php 
                        if ($this->beginCache('music-hottags', ['duration' => 3600])) {
                            $echo = '';
                            $label = array('label-default','label-primary','label-success','label-warning','label-info');
                            foreach($tags as $tag=>$weight)
                            {
                                $echo .= '<li><span class="label '.$label[rand(0,4)].'">';
                                $echo .= Html::a(Html::encode($tag), ['music/index','tag'=>$tag]);
                                $echo .= '</span></li>';
                            }
                            echo $echo;
                            $this->endCache();
                        }
                    ?>
                    </ul>   
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">活跃会员</div>
                <div class="panel-body">
                    <ul class="avatar-list">
                                    <li><a href="/User/2" data-original-title="" title=""><img src="/images/avatar/20150205153317_small.jpeg" alt=""></a></li>
                                    <li><a href="/User/1" data-original-title="" title=""><img src="/images/avatar/20150116135141_small.jpeg" alt=""></a></li>
                                    </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <?php $this->endContent(); ?>

