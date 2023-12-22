<?php

namespace respund\collector\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class SurveySearch extends Survey implements SearchInterface
{
    public bool $isSearchModel = true;

    /**
     * @return array<int, mixed>
     */
    public function rules() : array
    {
        return [
            [['name', 'key', 'uuid', 'status_id'], 'safe'],
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
        $query = Survey::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['survey_id'=>SORT_DESC]]
        ]);

        $this->load($params);
        $query
            ->andFilterWhere(['status_id'=> $this->status_id])

            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'uuid', $this->key])
        ;

        return $dataProvider;
    }

}