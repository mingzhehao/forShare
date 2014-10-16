<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class AdminController extends Controller
{
    //public $layout = 'left_panel';
    public $layout = 'left_panel';

    public $generator ;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','view'],
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

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'main';
        return $this->render('index');
    }

    public function actionView()
    {
        return $this->render('view');
        $generator = $this->loadGenerator($id);
        $params = ['generator' => $generator, 'id' => $id];
        if (isset($_POST['preview']) || isset($_POST['generate'])) {
            if ($generator->validate()) {
                $generator->saveStickyAttributes();
                $files = $generator->generate();
                if (isset($_POST['generate']) && !empty($_POST['answers'])) {
                    $params['hasError'] = $generator->save($files, (array) $_POST['answers'], $results);
                    $params['results'] = $results;
                } else {
                    $params['files'] = $files;
                    $params['answers'] = isset($_POST['answers']) ? $_POST['answers'] : null;
                }
            }
        }
    }


    /**
     * Loads the generator with the specified ID.
     * @param  string                $id the ID of the generator to be loaded.
     * @return \yii\gii\Generator    the loaded generator
     * @throws NotFoundHttpException
     */
    protected function loadGenerator($id='index')
    {
        if (isset($id)&& !empty($id)) {
            $this->generator = '';
            return $this->generator;
        } else {
            throw new NotFoundHttpException("Code generator not found: $id");
        }
    }

    public function generators()
    {
        return array(
                'add'       =>  '添加',
                'update'    =>  '更新',
                'select'    =>  '修改',
                'delete'    =>  '删除',
            );
    }


}
