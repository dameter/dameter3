<?php

namespace respund\collector\models;

use respund\collector\traits\ApplicationAwareTrait;
use yii\db\ActiveRecord as BaseActiverecord;


/**
 */
class ActiveRecord extends BaseActiverecord
{
    use ApplicationAwareTrait;

}