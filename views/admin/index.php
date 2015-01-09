<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\AdminSearch $searchModel
 */

$this->title = '用户';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [  
                'class' => DataColumn::className(),
                'attribute' => 'role', 
                'format' => 'text',
                'value' => function($data){
                        if($data->role=='1')
                            return "管理员";
                        else
                            return "会员";
                     },
            ],
            [  
                'attribute' => 'status', 
                'format' => 'text',
                'value' => function($data){
                        if($data->status=='0')
                            return "删除";
                        else
                            return "活跃";
                     },
            ],
            [  
                'attribute' => 'created_at', 
                'format' => 'text',
                'value' => function($data){return date("Y-m-d H:i:s",($data->created_at));},
            ],
            [  
                'attribute' => 'updated_at', 
                'format' => 'text',
                'value' => function($data){return date("Y-m-d H:i:s",($data->updated_at));},
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
