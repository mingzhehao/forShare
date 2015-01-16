<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $file
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['auth_key'], 'string', 'max' => 32],
            //[['file'], 'string', 'max' => 100]
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '用户名已存在.','on'=>'create'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '用户邮箱已存在','on'=>'create'],
            [['username','email'], 'required'],
            //user类用户内部创建用户相关，由于更新用户涉及不改变密码，所以取消密码必须填写规则
            [['username','password_reset_token', 'email'], 'string','max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => '认证Key',
            'password_hash' => '密码',
            'password_reset_token' => '密码重置Token',
            'email' => '用户邮箱',
            'role' => '用户角色',
            'status' => '用户状态',
            'created_at' => '注册时间',
            'updated_at' => '更新时间',
            'file' => '用户头像',
        ];
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    public function beforeSave()
    {
        $postData = Yii::$app->request->post();
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $this->created_at = time();
                $this->updated_at = time();
                //$this->password_hash = Yii::$app->security->generatePasswordHash($this->password_hash);
                $this->password_hash = Yii::$app->security->generatePasswordHash($postData["Admin"]["password_hash"]);
                $this->auth_key   = Yii::$app->security->generateRandomString();
                $this->password_reset_token = '';
            }
            else
            {
                $this->updated_at=time();

                if(!empty($postData["Admin"]["password_hash"])) 
                {
                    $this->password_hash = Yii::$app->security->generatePasswordHash($postData["Admin"]["password_hash"]);
                }
            }
            if(Yii::$app->user->getIdentity()->role == '1')
            {
                $this->role = $postData["Admin"]["role"];
                $this->status = $postData["Admin"]["status"];
            }
            else
                $this->role = '10';

            return true;
        }
        else
            return false;
    }


    /**
     * @param integer the maximum number of comments that should be returned
     * @return array the most recently added comments
     */
    public function getUserInfo($id)
    {
        if($id == Yii::$app->user->id)
            return Yii::$app->user->getIdentity();
        else
        {
            $user = User::find()->where(['id' => "$id"])->one();
            return $user;
        }
    }

}
