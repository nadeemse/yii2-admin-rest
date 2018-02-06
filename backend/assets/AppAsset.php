<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/animate.min.css',
        'css/paper-dashboard.css',
        'css/demo.css',
        'css/cms.css',
        'plugins/sweetalert/dist/sweetalert.css',
        'http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
        'https://fonts.googleapis.com/css?family=Muli:400,300',
        'css/themify-icons.css',
        'css/custom.css',
        'css/vertical-tabs.css',
    ];
    public $js = [
        'js/jquery-1.10.2.js',
        'js/bootstrap.min.js',
        'js/bootstrap-checkbox-radio.js',
        'js/chartist.min.js',
        'js/bootstrap-notify.js',
        'js/paper-dashboard.js',
        'plugins/sweetalert/dist/sweetalert.min.js', // Sweet alerts Core
        'js/demo.js',
        'plugins/tinymce/tinymce.min.js', // tinymce/ This is required to support Text-editor
        'js/text-editor.js', // Text Editor
        'js/file-uploader.js', // Text Editor
        'js/vertical-tabs.js', // vertical tabs

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
