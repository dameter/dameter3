<?php

namespace respund\collector;

use respund\collector\traits\ApplicationTrait;
use yii\web\Application;

class RespundWebApplication extends Application implements ApplicationInterface
{
    use ApplicationTrait;

}