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
        $this->getApp()->info("beforeSave");
        $parent = parent::beforeSave($insert);
        if(!$parent) {
            $this->getApp()->info("parent beforeSave failed ");
            return $parent;
        }
        if($insert) {
            $time = $this->currentTimeForDb();
            $this->getApp()->info("creating at time: ". $time);
            $this->time_created =$time;
            $this->time_updated =$time;
        }
        return true;
    }

}