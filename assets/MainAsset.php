<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.min.css',
    ];
    public $js = [
        'js/vendor.js',
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',        
    ];
}