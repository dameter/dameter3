<?php
declare(strict_types=1);

namespace respund\collector\models;
use respund\collector\traits\ApplicationAwareTrait;


/**
 * @property string $time_created
 * @property string $time_updated
 * @property string $time_completed
 * @property int $status_id
 */
class TimedActiveRecord extends ActiveRecord
{
    use ApplicationAwareTrait;

    const TIME_COL_LENGTH = 32;

    /**
     * @return array<mixed>
     */
    public function rules() : array
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