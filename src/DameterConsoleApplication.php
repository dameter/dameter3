<?php

namespace dameter\app;

use dameter\app\traits\ApplicationTrait;
use yii\console\Application;

class DameterConsoleApplication extends Application implements ApplicationInterface
{
    use ApplicationTrait;

}