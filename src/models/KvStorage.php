<?php

namespace vimZ\kvStorage\models;

use Yii;

/**
 * This is the model class for table "{{%kv_storage}}".
 *
 * @property string $key 键
 * @property string $value 值
 * @property int $type 类型
 * @property string $tip 提示
 * @property string $comment 注释
 * @property int $updated_at 创建时间
 * @property int $created_at 更新时间
 */
class KvStorage extends \yii\db\ActiveRecord
{
    const TYPE_TEXT = 1;
    const TYPE_WETHER = 2;
    const TYPE_DATE = 3;
    const TYPE_RATE = 4;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%kv_storage}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['value', 'comment'], 'string'],
            [['type', 'updated_at', 'created_at'], 'integer'],
            [['key', 'tip'], 'string', 'max' => 128],
            [['key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'key' => Yii::t('kv-storage', 'key'),
            'value' => Yii::t('kv-storage', 'value'),
            'type' => Yii::t('kv-storage', 'type'),
            'tip' => Yii::t('kv-storage', 'tip'),
            'comment' => Yii::t('kv-storage', 'comment'),
            'updated_at' => Yii::t('kv-storage', 'updated_at'),
            'created_at' => Yii::t('kv-storage', 'created_at'),
        ];
    }

    public static function getType($type = null)
    {
        if ($type === null) {
            $result = [
                self::TYPE_TEXT => Yii::t('kv-storage','text'),
                self::TYPE_WETHER => Yii::t('kv-storage','wether'),
                self::TYPE_DATE => Yii::t('kv-storage','date'),
                self::TYPE_RATE => Yii::t('kv-storage','rate'),
            ];
        } else {
            switch ($type) {
                case self::TYPE_TEXT:
                    $result = Yii::t('kv-storage','text');
                    break;
                case self::TYPE_WETHER:
                    $result = Yii::t('kv-storage','wether');
                    break;
                case self::TYPE_DATE:
                    $result = Yii::t('kv-storage','date');
                    break;
                case self::TYPE_RATE:
                    $result = Yii::t('kv-storage','rate');
                    break;
                default:
                    $result = '';
            }
        }

        return $result;
    }
}
