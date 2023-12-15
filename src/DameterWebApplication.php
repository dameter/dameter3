<?php

namespace dameter\app;

use dameter\app\traits\ApplicationTrait;
use yii\web\Application;

class DameterWebApplication extends Application implements ApplicationInterface
{
    use ApplicationTrait;

}