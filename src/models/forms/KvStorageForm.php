<?php


namespace vimZ\kvStorage\models\forms;

use function GuzzleHttp\Psr7\str;
use vimZ\kvStorage\models\KvStorage;
use yii\helpers\Json;

class KvStorageForm extends KvStorage
{

    public function rules()
    {
        return [
            [['tip', 'type', 'key', 'value'], 'required'],
            [['tip', 'key', 'comment'], 'string'],
            [['key'], 'unique'],
            [['type'], 'integer'],
            [['value'], 'encodeValue'],
        ];
    }

    public function encodeValue()
    {
        switch ($this->type) {
            case self::TYPE_TEXT:
                break;
            case self::TYPE_WETHER:
                break;
            case self::TYPE_DATE:
                $this->value = strtotime($this->value);
                break;
            case self::TYPE_RATIO:
            case self::TYPE_TEXT_RANGE:
                $this->value = Json::encode($this->value);
                break;
            case self::TYPE_DATE_RANGE:
                $value = explode(' - ', $this->value);
                foreach ($value as $k => $v) {
                    $value[$k] = strtotime($v);
                }
                $this->value = Json::encode($value);
        }
    }

    public function decodeValue()
    {
        switch ($this->type) {
            case self::TYPE_TEXT:
                break;
            case self::TYPE_WETHER:
                break;
            case self::TYPE_DATE:
                $this->value = date('Y/m/d H:i:s',$this->value);
                break;
            case self::TYPE_RATIO:
            case self::TYPE_TEXT_RANGE:
                $this->value = Json::decode($this->value);
                break;
            case self::TYPE_DATE_RANGE:
                $value = Json::decode($this->value);
                foreach ($value as $k => $v) {
                    $value[$k] = date('Y/m/d H:i:s',$v);
                }
                $this->value = implode(' - ',$value);
        }
    }
}