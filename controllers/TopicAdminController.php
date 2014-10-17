<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\TopicAdmin;
use app\models\TopicAdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Comment;

/**
 * TopicAdminController implements the CRUD actions for TopicAdmin model.
 */
class TopicAdminController extends Controller
{
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
                        //'actions' => '', //取消匹配所有操作
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TopicAdmin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'right_topic';
        $searchModel = new TopicAdminSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single TopicAdmin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'right_topic';
        $model   = $this->findModel($id);
        $comment = $this->newComment($model);

        return $this->render('view_user', [
            'model' => $model,
            'comment' => $comment,
        ]);
        /*非管理人员*/
        if(Yii::$app->user->role !=='1')
        {
            return $this->render('view_user', [
                'model' => $model,
                'comment' => $comment,
            ]);
        }
        return $this->render('view', [
            'model' => $model,
            'comment' => $comment,
        ]);
    }

    /**
     * Creates a new TopicAdmin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TopicAdmin;

        if ($model->load(Yii::$app->request->post()))
        {
            if($model->save()) 
                return $this->redirect(['view', 'id' => $model->id]);
        } 
        else 
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TopicAdmin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TopicAdmin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Lists all TopicAdmin models.
     * @return mixed
     */
    public function actionAdmin()
    {
        $searchModel = new TopicAdminSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('admin', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }


    /**
     * Finds the TopicAdmin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TopicAdmin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TopicAdmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
     * 获取每个分类总数
     */
    public function category()
    {
        $searchModel = new TopicAdmin;
        /*传递classify  &classify=1*/
        $classifyInfo = $searchModel->getClassify(Yii::$app->request->getQueryParams());
        return $classifyInfo;
    }

    /**
     * Creates a new comment.
     * This method attempts to create a new comment based on the user input.
     * If the comment is successfully created, the browser will be redirected
     * to show the created comment.
     * @param News the news that the new comment belongs to
     * @return Comment the comment instance
     */
    protected function newComment($model)
    {
        $comment=new Comment;
        if($comment->load(Yii::$app->request->post()))
        {
            /**验证通过***/
            $comment->attributes=$_POST['Comment'];
            if(Yii::$app->user->isGuest)
            {
                return $comment;
            }
            else
            {
                //$comment->author    = Yii::$app->user->getUserName();
                $comment->author_id = Yii::$app->user->id;
                var_dump($comment->attributes);exit;
            }
            if($comment->author === '')
            {
                Yii::$app->user->setFlash('commentSubmitted','请先登录');$this->refresh();
                exit();
            }
            $comment->content = $_POST['Comment']['content'];
            if($model->addComment($comment))
            {
                if($comment->status==Comment::STATUS_PENDING)
                    Yii::$app->user->setFlash('commentSubmitted','评论会在审核通过后显示。');
                $this->refresh();
            }
        }
        return $comment;
    }

}
