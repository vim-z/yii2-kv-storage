<?php


namespace vimZ\kvStorage\components;


use yii\base\Component;
use yii\base\Exception;
use yii\caching\TagDependency;
use vimZ\kvStorage\models\KvStorage as KvStorageModel;
use yii\helpers\Json;

class KvStorage extends Component
{
    const CACHE_TAG = 'kv-storage';

    /**
     * 缓存过期时间设置
     * @var int
     */
    public $cacheDuration = 3600;

    /**
     * 缓存前缀
     * @var string
     */
    public $cachePrefix = '';

    private $cache;

    public function init()
    {
        if (!\Yii::$app->getCache()) {
            \Yii::$app->setComponents([
                'cache' => [
                    'class' => 'yii\caching\DummyCache',
                ]
            ]);
        }
    }


    /**
     * 获取单个配置
     * @param $key
     * @return array|mixed|KvStorageModel|\yii\db\ActiveRecord|null
     */
    public function get($key)
    {
        $cache = \Yii::$app->cache;

        if (!$cache->get($this->cachePrefix . $key)) {
            $config = KvStorageModel::find()->where(['key' => $key])->asArray()->one();
            if (!empty($config)) {
                $cache->set($this->cachePrefix . $key, $config, $this->cacheDuration, new TagDependency(['tags' => static::CACHE_TAG]));
            }
            return $config;
        }

        return $cache->get($this->cachePrefix . $key);
    }

    /**
     * 获取value
     * @param $key
     * @return value|NULL
     */
    public function getValue($key)
    {
        $resutl = $this->get($key);
        if ($resutl) {
            return $resutl['value'];
        }
        return null;
    }


    /**
     * 清楚所有kv缓存
     */
    public function flush(): void
    {
        TagDependency::invalidate(\Yii::$app->cache, static::CACHE_TAG);
    }

    /**
     * 根据键清楚缓存
     * @param $key
     * @return bool
     */
    public function deleteCache($key)
    {
        $cache = \Yii::$app->cache;
        if ($cache->get($this->cachePrefix . $key)) {
            return $cache->delete($this->cachePrefix . $key);
        }
        return true;
    }

    /**
     * 设置kv方法
     * @param $key 键
     * @param $value 值 type:1 string;2: 0|1；3：date;4:[10,100];5:[10:100];6:'2019/01/01 00:00:00 - 2020/12/01 23:59:59'
     * @param $type 类型 1:text;2:wether;3:date;4:ratio;5:text-range;6:date-range
     * @param $tip 提示
     * @param string $comment 备注
     * @return bool|int
     * @throws Exception
     * @example Yii::$app->kv->set('test1','2019-08-13 00:00:00',3,'test1')
     */
    public function set($key, $value, $type, $tip, $comment = '')
    {
        $time = time();
        $data[] = [
            'key' => $key,
            'value' => $value,
            'type' => $type,
            'tip' => $tip,
            'comment' => $comment,
            'created_at' => $time,
            'updated_at' => $time,
        ];
        return $this->multiSet($data);
    }

    /**
     * @param $data
     * @return bool|int
     * @throws Exception
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     * @example Yii::$app->kv->multiSet([['key' => 'test1','value' => 'test1','type' => 1,'tip' => 'test1']])
     */
    public function multiSet($data)
    {
        if (empty($data)) {
            return false;
        }

        $insert_data = [];
        foreach ($data as $k => $v) {
            if (!isset($v['key']) || !isset($v['value']) || !isset($v['type']) || !isset($v['tip'])) {
                throw new Exception('params error');
            }

            $time = time();
            $insert_data[] = [
                'key' => $v['key'],
                'value' => $this->encodeValue($v['type'], $v['value']),
                'type' => $v['type'],
                'tip' => $v['tip'],
                'comment' => $v['comment'] ?? '',
                'created_at' => $time,
                'updated_at' => $time,
            ];
        }
        $columnNames = KvStorageModel::getTableSchema()->columnNames;
        return \Yii::$app->db->createCommand()->batchInsert('{{%kv_storage}}', $columnNames, $insert_data)->execute();
    }

    private function encodeValue($type, $value)
    {
        switch ($type) {
            case KvStorageModel::TYPE_TEXT:
            case KvStorageModel::TYPE_WETHER:
                $value = $value;
                break;
            case KvStorageModel::TYPE_DATE:
                $value = strtotime($value);
                break;
            case KvStorageModel::TYPE_RATIO:
            case KvStorageModel::TYPE_TEXT_RANGE:
                $value = Json::encode($value);
                break;
            case KvStorageModel::TYPE_DATE_RANGE:
                $value = explode(' - ', $value);
                foreach ($value as $k => $v) {
                    $value[$k] = strtotime($v);
                }
                $value = Json::encode($value);
                break;
            default:
                throw new Exception('type is error');
        }

        return $value;
    }
}