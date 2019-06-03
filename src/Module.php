<?php

namespace vimZ\kvStorage;

use Yii;

/**
 * mall module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'vimZ\kvStorage\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!isset(Yii::$app->i18n->translations['kv-storage'])) {
            Yii::$app->i18n->translations['kv-storage'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath' => '@vimZ/kvStorage/messages',
            ];
        }
        // custom initialization code goes here
    }
}
