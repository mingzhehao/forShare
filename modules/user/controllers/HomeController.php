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

use app\models\UploadForm;
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
            $files = UploadedFile::getInstances($model, 'file');
            var_dump($files);exit;

            foreach ($files as $file) {

                $_model = new UploadForm();

                $_model->file = $file;

                if ($_model->validate()) {
                    $_model->file->saveAs('uploads/' . $_model->file->baseName . '.' . $_model->file->extension);
                } else {
                    foreach ($_model->getErrors('file') as $error) {
                        $model->addError('file', $error);
                    }
                }
            }

            if ($model->hasErrors('file')){
                $model->addError(
                    'file',
                    count($model->getErrors('file')) . ' of ' . count($files) . ' files not uploaded'
                );
            }

        }

        return $this->render('avatar', ['model' => $model]);



        $model = new UploadForm();
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
