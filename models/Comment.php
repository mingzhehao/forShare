<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $author_id
 * @property string $author_name
 * @property integer $comment_parent_id
 * @property string $create_time
 * @property integer $post_id
 * @property integer $user_id
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'status', 'author_id', 'author_name', 'comment_parent_id', 'post_id', 'user_id'], 'required'],
            [['content'], 'string'],
            [['status', 'author_id', 'comment_parent_id', 'post_id', 'user_id'], 'integer'],
            [['create_time'], 'safe'],
            [['author_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'content' => Yii::t('app', '内容'),
            'status' => Yii::t('app', '状态'),
            'author_id' => Yii::t('app', '评论作者ID'),
            'author_name' => Yii::t('app', '评论作者名称'),
            'comment_parent_id' => Yii::t('app', '父ID'),
            'create_time' => Yii::t('app', '创建时间'),
            'post_id' => Yii::t('app', '文章ID'),
            'user_id' => Yii::t('app', '文章作者ID'),
        ];
    }
}
