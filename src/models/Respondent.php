<?php

namespace respund\collector\models;
use respund\collector\traits\KeyRecordTrait;
use respund\collector\traits\UuidRecordTrait;
use yii\db\ActiveQuery;

/**
 * @property int $respondent_id
 * @property int $survey_id
 * @property int $language_id
 * @property string $uuid
 * @property string $key
 * @property ?string $params json
 *
 * @property Survey $survey
 * @property ?Response $response
 */
class Respondent extends TimedActiveRecord
{
    use UuidRecordTrait;
    use KeyRecordTrait;

    public function rules()
    {
        return array_merge(parent::rules(),[
            [['survey_id', 'status_id', 'uuid', 'language_id', 'key'], 'required'],
            [['uuid','key'], 'string', 'max' => 45],
            [['uuid'], 'unique'],
            [['params'], 'string'],
            [['language_id'], 'integer'],
            [['survey_id'], 'integer'],
        ]);
    }



    public function getSurvey(): ActiveQuery
    {
        return $this->hasOne(Survey::class, ['survey_id' => 'survey_id']);
    }

    public function getResponse(): ActiveQuery
    {
        return $this->hasOne(Response::class, ['respondent_id' => 'respondent_id']);
    }

}