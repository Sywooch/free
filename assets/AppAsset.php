<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

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
        'css/style.css',
        'js/jquery-ui-1.12.1.custom/jquery-ui.min.css',
        'js/jquery-ui-1.12.1.custom/jquery-ui.structure.min.css',
        'js/jquery-ui-1.12.1.custom/jquery-ui.theme.min.css',
        'css/fontello/css/fontello.css',
        'https://fonts.googleapis.com/css?family=Open+Sans|Padauk|Roboto+Condensed',
    ];
    public $js = [
        'js/googleMap_1.js',
        'js/googleMap_2.js',
        "https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBogj6FNcdBueaV1iG3OsiLp_UrEjNZWyo&callback=printMap",
//        'js/jquery-ui-1.12.1.custom/external/jquery/jquery.js',
        'js/jquery-ui-1.12.1.custom/jquery-ui.js',
        'js/datepicker-ru.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
    ];
}
