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
            [['username','password_hash','email'], 'required'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string','max' => 255],
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
}
