<?php

namespace app\modules\user\controllers;

use yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\UserSearch;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\helpers\Url;

class HomeController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','login'],
                'rules' => [
                    [
                        'actions' => ['signup','login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /*用户个人主页*/
    public function actionIndex()
    {
        $id = Yii::$app->request->getQueryParam('id');
        if(isset($id) && !empty($id))
            $model = User::getUserInfo($id);
        else
            $model = User::getUserInfo(Yii::$app->user->id);
        if(empty($model))
        {
            return $this->render('error',['id'=>$id]);
        }
        $this->layout = 'right_user';
        return $this->render('index',['model'=>$model,]);
    }

    /*用户账号设置*/
    public function actionSetting()
    {
        $model = User::find()->one();
        if(empty($model))
        {
            return $this->render('error',['id'=>Yii::$app->user->id]);
        }
        $this->layout = 'right_user_setting';
        return $this->render('setting',['model'=>$model,]);
    }

    /*用户头像设置*/
    public function actionAvatar()
    {
        $model = User::find()->one();
        if(empty($model))
        {
            return $this->render('error',['id'=>Yii::$app->user->id]);
        }
        $this->layout = 'right_user_setting';
        return $this->render('avatar',['model'=>$model,]);
    }

    public function actionPassword()
    {
        $id = Yii::$app->request->getQueryParam('id');
        if(isset($id) && !empty($id))
            $model = User::getUserInfo($id);
        else
            $model = User::getUserInfo(Yii::$app->user->id);
        if(empty($model))
        {
            return $this->render('error',['id'=>$id]);
        }
        $this->layout = 'right_user';
        return $this->render('index',['model'=>$model,]);
    }
}
