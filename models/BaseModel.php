<?php
/* 自己定义的基类，用来处理自定义数据
 * 便于统一配置以及获取 
 */

namespace app\models;

use Yii;

class BaseModel extends \yii\db\ActiveRecord
{
    /*
     * 文章相关状态定义，作用与所有
     */
    public function getList()
    {
        $licenses = array(
            '1' => '等待审核',
            '2' => '审核通过',
            '3' => '私人所属',
            '4' => '禁止发布',
            );
        return $licenses;
        //return array_combine($licenses, $licenses);
    }
    
    /*
     * topic话题讨论定义分类
     * 1.可以使用数据库
     * 2.也可以使用自定义数组
     */
    public function topicClassify()
    {
        $licenses = array(
            '1' => '科技生活',
            '2' => '娱乐天下',
            '3' => '一言一语',
            '4' => '新闻动态',
            );
        return $licenses;
    }
}
