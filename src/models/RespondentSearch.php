<?php

namespace respund\collector\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class RespondentSearch extends Respondent implements SearchInterface
{
    public bool $isSearchModel = true;
    public ?string $survey_status_id = null;

    /**
     * @return array<int, mixed>
     */
    public function rules() : array
    {
        return [
            [['language_id', 'key', 'uuid', 'survey_id', 'status_id'], 'safe'],
            [['survey_status_id'], 'safe'],
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
        $query = Respondent::find()->joinWith('survey');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['respondent_id'=>SORT_DESC]]
        ]);

        $this->load($params);
        $query
            ->andFilterWhere(['respondent.language_id'=> $this->language_id])
            ->andFilterWhere(['respondent.survey_id'=> $this->survey_id])
            ->andFilterWhere(['respondent.status_id'=> $this->status_id])

            ->andFilterWhere(['like', 'respondent.key', $this->key])
            ->andFilterWhere(['like', 'respondent.uuid', $this->key])

            ->andFilterWhere(['like', 'survey.status_id', $this->survey_status_id])
        ;

        return $dataProvider;
    }

}