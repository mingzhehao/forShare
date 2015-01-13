<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\user\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/panels.css',
        'css/style.css',
        'css/jasny-bootstrap.css',
        'css/cropper/cropper.min.css',
        'css/cropper/crop-avatar.css',
    ];
    public $js = [
        'js/main.js',
        'js/jquery.jscrollpane.min.js',
        'js/jquery.mousewheel.min.js',
        'js/jasny-bootstrap.js',
        'js/jquery.Jcrop.js',
        'js/cropper/cropper.min.js',
        'js/cropper/crop-avatar.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
