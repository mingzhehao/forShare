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
 */
class User extends \yii\db\ActiveRecord
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
            //[['username', 'password_hash', 'password_reset_token', 'email'], 'string','min'=>8,'max' => 255],
            //[['auth_key'], 'string', 'max' => 32]
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
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password_hash);
                $this->auth_key   = Yii::$app->security->generateRandomString();
                $this->password_reset_token = '';
            }
            else
            {
                $this->updated_at=time();

                if(!empty($postData["User"]["password_hash"])) 
                {
                    $this->password_hash = Yii::$app->security->generatePasswordHash($postData["User"]["password_hash"]);
                }
            }
            if(Yii::$app->user->getIdentity()->role == '1')
            {
                $this->role = $postData["User"]["role"];
                $this->status = $postData["User"]["status"];
            }
            else
                $this->role = '10';

            return true;
        }
        else
            return false;
    }

}
