<?php

namespace dameter\app\models;

/**
 * @property string $key
 * @property string $uuid
 * @property string $name
 * @property ?string $external_id
 * @property string $structure json surveyjs object
 */
class Survey extends TimedActiveRecord
{
    public function rules()
    {
        return array_merge(parent::rules(),[
            [['structure'], 'string'],
            [['key', 'uuid'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 255],
        ]);
    }

}