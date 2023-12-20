<?php

namespace respund\collector\models;

use respund\collector\traits\KeyRecordTrait;
use respund\collector\traits\UuidRecordTrait;
use yii\db\ActiveQuery;

/**
 * @property string $key
 * @property string $uuid
 * @property string $name
 * @property ?string $external_id
 * @property string $structure json surveyjs object
 */
class Survey extends TimedActiveRecord
{
    use UuidRecordTrait;
    use KeyRecordTrait;

    public function rules()
    {
        return array_merge(parent::rules(),[
            [['structure'], 'string'],
            [['key', 'uuid'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 255],
        ]);
    }

    public function getRespondents(): ActiveQuery
    {
        return $this->hasMany(Respondent::class, ['survey_id' => 'survey_id'])
            ->indexBy('uuid');
    }

    public function getResponses(): ActiveQuery
    {
        return $this->hasMany(Response::class, ['survey_id' => 'survey_id'])
            ->indexBy('uuid');
    }

    public function structureItem(string $name) :array
    {
        $data = json_decode($this->structure, true);

        foreach ($data['pages'] as $page) {
            foreach ($page['elements'] as $element) {
                if($element['name'] == $name) {
                    return $element;
                }
            }
        }
        return [];
    }

}