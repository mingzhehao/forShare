<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Music;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * 处理用户点赞相关
 *
 */
class VoteController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'up'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $params = Yii::$app->request->get();
        extract($params);
        define('TYPE',ucfirst($type));
        /*动态处理每一个type分类*/
        $TYPE = TYPE;
        $appClass = "\\app\models\\$TYPE";
        if(isset($action) && in_array($action,array('up','down')))
        {
            /*判断用户是否已经点击过,通过cookie判断*/
            $cookiename = $type.'_'.$action.'_'.$id;
            
            $cookievalue = getDomainCookie($cookiename);

            if(isset($cookievalue))
            {
                exit(json_encode(array('stat'=>'-1','retmsg'=>'请勿重复点击')));
            }
            $model = new $appClass;
            if (($model = $model->findOne($id)) !== null) 
            {
                if($action === 'up')
                {
                    $model->up +=1;              
                    $model->save();
                    /*cookie写入，防止多次提交*/
                }
                else
                {
                    $model->down +=1;              
                }
                setDomainCookie($cookiename,1,7200);
                exit(json_encode(array('stat'=>'ok','up'=>$model->up)));

            } 
            else 
            {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
        else
        {
            exit(json_encode(array('stat'=>'-2','retmsg'=>'处理失败!')));
        }
        
    }
}
