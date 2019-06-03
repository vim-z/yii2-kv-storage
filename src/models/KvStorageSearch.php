<?php

namespace vimZ\kvStorage\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use vimZ\kvStorage\models\KvStorage;

/**
 * KvStorageSearch represents the model behind the search form of `vimZ\kvStorage\models\KvStorage`.
 */
class KvStorageSearch extends KvStorage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'value', 'tip', 'comment'], 'safe'],
            [['type', 'updated_at', 'created_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = KvStorage::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'type' => $this->type,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'tip', $this->tip])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
