<?php

namespace dameter\app\models;
/**
 * @property int $respondent_id
 * @property int $survey_id
 * @property int $language_id
 * @property string $uuid
 * @property string $key
 * @property ?string $params json
 */
class Respondent extends TimedActiveRecord
{
    public function rules()
    {
        return array_merge(parent::rules(),[
            [['uuid', 'key'], 'string', 'max' => 45],
            [['uuid', 'key'], 'unique'],
            [['params'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['language_id'], 'integer'],
            [['survey_id'], 'integer'],

        ]);
    }


}