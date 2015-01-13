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

use app\modules\user\models\CropAvatar;
use yii\web\UploadedFile;

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
        $this->layout = 'left_user';
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
        $this->layout = 'left_user_setting';
        return $this->render('setting',['model'=>$model,]);
    }

    /*用户头像设置*/
    public function actionAvatar()
    {
        $model = new User();
        $this->layout = 'left_user_setting';

        if (Yii::$app->request->isPost) {
            $postAvatar = Yii::$app->request->post();
            $crop = new CropAvatar($postAvatar['avatar_src'], $postAvatar['avatar_data'], $_FILES['avatar_file']);
            $response = array(
                'state'  => 200,
                'message' => $crop -> getMsg(),
                'result' => $crop -> getResult()
            );

        }

        return $this->render('avatarCropper', ['model' => $model]);



        $model = new CropAvatar();
        if (Yii::$app->request->isPost) {
            var_dump($_POST);exit;
            //$model->file = UploadedFile::getInstance($model, 'file');
        }

        $model = User::find()->one();
        if(empty($model))
        {
            return $this->render('error',['id'=>Yii::$app->user->id]);
        }
        $this->layout = 'left_user_setting';
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
        $this->layout = 'left_user';
        return $this->render('index',['model'=>$model,]);
    }
}
