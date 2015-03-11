<?php

namespace app\controllers;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionCookie()
    {
        $cookiename = $type.'_'.$action.'_'.$id;
        $cookies = Yii::$app->request->cookies;
        $cookievalue = $cookies->get("$cookiename");

        echo "<br/><br/>";


        $cookies = Yii::$app->response->cookies;

        // 在要发送的响应中添加一个新的cookie
        $cookies->add(new \yii\web\Cookie([
            'name' => $cookiename,
            'value' => 'zh-CN',
            'expire' => time() +20,
        ]));
        echo "<br/><br/>";

        echo "<br/><br/>";
        var_dump(Yii::$app->getResponse()->getCookies()->getValue("$cookiename"));
        echo "<br/><br/>";
    }

}
