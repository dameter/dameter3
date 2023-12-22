<?php

namespace respund\collector\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class RespondentSearch extends Respondent implements SearchInterface
{
    public bool $isSearchModel = true;

    /**
     * @return array<int, mixed>
     */
    public function rules() : array
    {
        return [
            [['language_id', 'key', 'uuid'], 'safe'],
        ];
    }

    /**
     * @return array<int, mixed>
     */
    public function scenarios() : array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array<string, mixed> $params
     */
    public function search(array $params) : ActiveDataProvider
    {
        $query = Respondent::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['respondent_id'=>SORT_DESC]]
        ]);

        $this->load($params);
        $query
            ->andFilterWhere(['language_id'=> $this->language_id])

            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'uuid', $this->key])
        ;

        return $dataProvider;
    }

}