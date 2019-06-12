<?php


namespace vimZ\kvStorage\assets;


use yii\web\AssetBundle;

class KvStorageAsset extends AssetBundle
{
    public $sourcePath = '@vimZ/kvStorage/assets/dist/';

    public $css = [
        'css/font-awesome.min.css',
        'css/ionicons.min.css',
        'css/daterangepicker.css',
        'css/kv-storage.css'
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/moment.min.js',
        'js/daterangepicker.js',
        'js/kv-storage.js',
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