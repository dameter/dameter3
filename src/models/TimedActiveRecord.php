<?php

namespace dameter\app\models;
use dameter\app\traits\ApplicationAwareTrait;
use yii\db\ActiveRecord as BaseActiverecord;


/**
 * @property string $time_created
 * @property string $time_updated
 * @property string $time_completed
 * @property int $status_id
 */
class TimedActiveRecord extends BaseActiverecord
{
    use ApplicationAwareTrait;

    const TIME_COL_LENGTH = 100; //FIXME ??
    public function rules()
    {
        return [
            [['time_created', 'time_updated', 'time_completed'], 'string', 'max' => self::TIME_COL_LENGTH],
            [['status_id'], 'integer'],
        ];
    }

    public function beforeSave($insert) : bool
    {
        $parent = parent::beforeSave($insert);
        if(!$parent) {
            return $parent;
        }
        if($insert) {
            $time = $this->currentTimeForDb();
            $this->time_created =$time;
            $this->time_updated =$time;
        }
        return true;
    }

}