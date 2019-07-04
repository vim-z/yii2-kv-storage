<?php


namespace vimZ\kvStorage\components;


use yii\base\Component;
use yii\caching\DummyCache;
use yii\caching\TagDependency;
use vimZ\kvStorage\models\KvStorage as KvStorageModel;

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
    public function get($key): array
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
     * 获取多个配置
     * @param null $key 配置键前缀，test.test1  test.test2 可以用test.*来获取
     * @return array|mixed|KvStorageModel[]|\yii\db\ActiveRecord[]
     */
    public function getAll($key = null): array
    {
        $cache = \Yii::$app->cache;

        if ($key === null) {
            $key = 'kv-storage';
        }

        if (!$cache->get($this->cachePrefix . $key)) {
            if (preg_match('/\*/', $key, $matches, PREG_OFFSET_CAPTURE)) {
                $dbKey = substr($key, 0, $matches[0][1]);
                $config = KvStorageModel::find()->where('`key` like \'' . $dbKey . '%\'')->asArray()->all();
            } else {
                $config = KvStorageModel::find()->where(['key' => $key])->asArray()->all();
            }

            if (!empty($config)) {
                $cache->set($this->cachePrefix . $key, $config, $this->cacheDuration, new TagDependency(['tags' => static::CACHE_TAG]));
            }
            return $config;
        }

        return $cache->get($this->cachePrefix . $key);
    }

    public function flush(): void
    {
        TagDependency::invalidate(\Yii::$app->cache, static::CACHE_TAG);
    }
}