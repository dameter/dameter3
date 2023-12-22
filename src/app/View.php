<?php
declare(strict_types=1);

namespace respund\collector\app;

use respund\collector\exceptions\RespundException;
use yii\web\Request;

class View extends \yii\web\View
{
    public function request() : Request
    {

        $app = \Yii::$app;
        if(!($app instanceof RespundWebApplication)) {
            throw new RespundException("Invalid app type here");
        }
        return $app->request;
    }

}