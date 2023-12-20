<?php
declare(strict_types=1);

namespace respund\collector\traits;

use respund\collector\RespundConsoleApplication;
use respund\collector\RespundWebApplication;
use respund\collector\exceptions\RespundException;
use Yii;

trait ApplicationAwareTrait
{
    public function getApp() : RespundConsoleApplication|RespundWebApplication
    {
        /** @var RespundConsoleApplication|RespundWebApplication $app */
        $app =  Yii::$app;
        return $app;
    }

    public function getWebApp() : RespundWebApplication
    {
        $app = $this->getApp();
        if($app instanceof RespundWebApplication) {
            return $app;
        }
        throw new RespundException("invalid app type");
    }

    public function isConsoleApp() : bool
    {
        return $this->getApp() instanceof RespundConsoleApplication;
    }

    public function currentTime() : \DateTime
    {
        return new \DateTime();
    }

    public function currentTimeForDb(): string
    {
        return $this->currentTime()->format("Y-m-d H:i:s.u");
    }



}