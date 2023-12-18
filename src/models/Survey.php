<?php

namespace respund\collector\models;

use respund\collector\traits\KeyedRecordTrait;

/**
 * @property string $key
 * @property string $uuid
 * @property string $name
 * @property ?string $external_id
 * @property string $structure json surveyjs object
 */
class Survey extends TimedActiveRecord
{
    use KeyedRecordTrait;

    public function rules()
    {
        return array_merge(parent::rules(),[
            [['structure'], 'string'],
            [['key', 'uuid'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 255],
        ]);
    }

}