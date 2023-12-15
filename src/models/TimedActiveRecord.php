<?php

namespace dameter\app\models;
use yii\db\ActiveRecord as BaseActiverecord;


/**
 * @property string $time_created
 * @property string $time_updated
 * @property string $time_completed
 * @property int $status_id
 */
class TimedActiveRecord extends BaseActiverecord
{
    const TIME_COL_LENGTH = 100; //FIXME ??
    public function rules()
    {
        return [
            [['time_created', 'time_updated', 'time_completed'], 'string', 'max' => self::TIME_COL_LENGTH],
            [['status_id'], 'integer'],
        ];
    }

}