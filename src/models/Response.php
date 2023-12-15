<?php

namespace dameter\app\models;

/**
 * @property int $response_id
 * @property int $nr sequence nr within one survey
 * @property string $uuid
 * @property int $status_id
 * @property string $data response data in json
 */
class Response extends TimedActiveRecord
{
    public function rules()
    {
        return array_merge(parent::rules(),[
            [['uuid'], 'string', 'max' => 45],
            [['uuid'], 'unique'],
            [['nr'], 'integer'],
            [['status_id'], 'integer'],
            [['survey_id'], 'integer'],
            [['respondent_id'], 'integer'],

            [['data'], 'string'],
            [['time_completed'], 'string', 'max' => self::TIME_COL_LENGTH],
            [['name'], 'string', 'max' => 255],

        ]);
    }


}