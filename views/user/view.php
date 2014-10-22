<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\User $model
 */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '用户', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            [
                'attribute'=>'status', 
                //'label'=>'Available?',
                'format'=>'raw',
                'value'=>$model->status =='10' ? 
                    '<span class="label label-success">活跃</span>' : 
                    '<span class="label label-danger">封禁</span>',
            ],
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [
                'attribute'=>'role', 
                //'label'=>'Available?',
                'format'=>'raw',
                'value'=>$model->role =='10' ? 
                    '<span class="label label-warning">会员</span>' : 
                    '<span class="label label-success">管理员</span>',
            ],
            [
                'attribute'=>'created_at', 
                'value' => date("Y-m-d H:i:s",$model->created_at)
            ],
            [
                'attribute'=>'updated_at', 
                'value' => date("Y-m-d H:i:s",$model->updated_at)
            ],
        ],
    ]) ?>

</div>
