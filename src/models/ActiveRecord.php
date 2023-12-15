<?php

namespace dameter\app\models;

use dameter\app\traits\ApplicationAwareTrait;
use yii\db\ActiveRecord as BaseActiverecord;


/**
 */
class ActiveRecord extends BaseActiverecord
{
    use ApplicationAwareTrait;

}