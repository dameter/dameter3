<?php
declare(strict_types=1);

namespace respund\collector\app;

use respund\collector\traits\ApplicationTrait;
use yii\console\Application;

class RespundConsoleApplication extends Application implements ApplicationInterface
{
    use ApplicationTrait;

}