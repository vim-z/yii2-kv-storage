<?php


namespace vimZ\kvStorage\assets;


use yii\web\AssetBundle;

class DatePickerAsset extends AssetBundle
{
    public $sourcePath = '@vimZ/kvStorage/assets/dist/';

    public $css = [
        'css/font-awesome.min.css',
        'css/ionicons.min.css',
        'css/bootstrap-datepicker.min.css',
        'css/daterangepicker.css'
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/moment.min.js',
        'js/bootstrap-datepicker.min.js',
        'js/daterangepicker.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}