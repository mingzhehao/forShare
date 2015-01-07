<?php
use yii\helpers\Html;
use app\models\Humour;
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
$humourClassify = Humour::humourClassify();
/*热门文章*/
$hotPosts = Humour::getHotPosts();
/*热门标签*/
$tags =Tag::findTagWeights(20);

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
        <a class="btn btn-success btn-lg btn-block" href="/humour/create"><span class="glyphicon glyphicon-plus"></span> 发布主题</a>
        <?php
            /***片段缓存----分类****/
            if ($this->beginCache('humour-classify', ['duration' => 3600])) {
                $echo = '<div id="w2" class="list-group"><a class="list-group-item active" href="/humour"><span class="badge">{totalnum}</span>全部主题</a>';
                $totalnum = 0;
                foreach ($category as $key => $val)
                {
                    $echo .= '<a class="list-group-item" href="/humour/index?classify='.$val['classify'].'"><span class="badge">'.$val['counts'].'</span>'.$humourClassify[$val["classify"]].'</a>';
                    $totalnum += $val['counts'];
                } 
                $echo = str_replace('{totalnum}',$totalnum,$echo);
                echo $echo;
                $this->endCache();
            }
        ?>
                <a class="list-group-item" href="/humour?category=1"><span class="badge">2510</span>新手入门</a>
                <a class="list-group-item" href="/humour?category=2"><span class="badge">30</span>求助交流</a>
                <a class="list-group-item" href="/humour?category=3"><span class="badge">66</span>技术分享</a>
                <a class="list-group-item" href="/humour?category=4"><span class="badge">9</span>站务公告</a>
                <a class="list-group-item" href="/humour?category=5"><span class="badge">29</span>求职招聘</a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">热门主题</div>
                <div class="panel-body">
                    <ul class="list">
                    <?php 
                        if ($this->beginCache('humour-hotposts', ['duration' => 3600])) {
                            $echo = '';
                            foreach($hotPosts as $key => $val)
                            {   
                                $echo .= '<li><a href="/humour/view?id='.$val[id].'" title="" data-toggle="tooltip" data-original-title="'.$val[title].'">'.$val[title].'</a></li>';
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
                        if ($this->beginCache('humour-hottags', ['duration' => 3600])) {
                            $echo = '';
                            $label = array('label-default','label-primary','label-success','label-warning','label-info');
                            foreach($tags as $tag=>$weight)
                            {
                                $echo .= '<li><span class="label '.$label[rand(0,4)].'">';
                                $echo .= Html::a(Html::encode($tag), ['humour/index','tag'=>$tag]);
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
                                    <li><a href="/user/821" data-original-title="" title=""><img src="/uploads/avatar/000/00/08/21_avatar_small.jpg" alt=""></a></li>
                                    <li><a href="/user/2" data-original-title="" title=""><img src="/uploads/avatar/000/00/00/02_avatar_small.jpg" alt=""></a></li>
                                    <li><a href="/user/5795" data-original-title="" title=""><img src="/uploads/avatar/000/00/57/95_avatar_small.jpg" alt=""></a></li>
                                    <li><a href="/user/13302" data-original-title="" title=""><img src="/uploads/avatar/000/01/33/02_avatar_small.jpg" alt=""></a></li>
                                    <li><a href="/user/3535" data-original-title="" title=""><img src="/uploads/avatar/000/00/35/35_avatar_small.jpg" alt=""></a></li>
                                    <li><a href="/user/49" data-original-title="" title=""><img src="/uploads/avatar/000/00/00/49_avatar_small.jpg" alt=""></a></li>
                                    </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <?php $this->endContent(); ?>

