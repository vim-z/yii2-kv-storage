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
    /**
     * 类型，1：字符串或者数字；2：是否；3：时间；4：比例；5：数字范围；6：时间范围
     */
    const TYPE_TEXT = 1;
    const TYPE_WETHER = 2;
    const TYPE_DATE = 3;
    const TYPE_RATIO = 4;
    const TYPE_TEXT_RANGE = 5;
    const TYPE_DATE_RANGE = 6;

    const TYPE_ARR = [
        self::TYPE_TEXT,
        self::TYPE_WETHER,
        self::TYPE_DATE,
        self::TYPE_RATIO,
        self::TYPE_TEXT_RANGE,
        self::TYPE_DATE_RANGE,
    ];

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
            [['key', 'type'], 'required'],
            [['value', 'comment'], 'string'],
            [['type', 'updated_at', 'created_at'], 'integer'],
            [['type'], 'in', 'range' => self::TYPE_ARR, 'message' => Yii::t('kv-storage', 'Please choose the right type')],
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
                self::TYPE_TEXT => Yii::t('kv-storage', 'text'),
                self::TYPE_WETHER => Yii::t('kv-storage', 'wether'),
                self::TYPE_DATE => Yii::t('kv-storage', 'date'),
                self::TYPE_RATIO => Yii::t('kv-storage', 'ratio'),
                self::TYPE_TEXT_RANGE => Yii::t('kv-storage', 'text range'),
                self::TYPE_DATE_RANGE => Yii::t('kv-storage', 'date range'),
            ];
        } else {
            switch ($type) {
                case self::TYPE_TEXT:
                    $result = Yii::t('kv-storage', 'text');
                    break;
                case self::TYPE_WETHER:
                    $result = Yii::t('kv-storage', 'wether');
                    break;
                case self::TYPE_DATE:
                    $result = Yii::t('kv-storage', 'date');
                    break;
                case self::TYPE_RATIO:
                    $result = Yii::t('kv-storage', 'ratio');
                    break;
                case self::TYPE_TEXT_RANGE:
                    $result = Yii::t('kv-storage', 'text range');
                    break;
                case self::TYPE_DATE_RANGE:
                    $result = Yii::t('kv-storage', 'date range');
                    break;
                default:
                    $result = '';
            }
        }

        return $result;
    }
}
