<?php
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \yii\gii\Generator[] $generators
 * @var \yii\gii\Generator $activeGenerator
 * @var string $content
 */
$generators = Yii::$app->controller->generators();
//$activeGenerator = Yii::$app->controller->generator;
$activeGenerator = isset($_GET['id'])?$_GET['id']:'add';
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<?php //$this->beginContent('@app/views/layouts/main.php'); ?>
<style type="text/css">
.list-group .glyphicon {
        float: right;
}
</style>
<div class="row">
    <div class="col-md-3 col-sm-4">
        <div class="list-group">
            <?php
            foreach ($generators as $id => $generator) {
                $label = '<i class="glyphicon glyphicon-chevron-right"></i>' . Html::encode($generator);
                echo Html::a($label, ['admin/view', 'id' => $id], [
                    'class' => $id === $activeGenerator ? 'list-group-item active' : 'list-group-item',
                ]);
            }
            ?>
        </div>
    </div>
    <div class="col-md-9 col-sm-8">
        <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>

