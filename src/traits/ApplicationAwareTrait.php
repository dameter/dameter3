<?php

namespace dameter\app\traits;

use dameter\app\DameterConsoleApplication;
use dameter\app\DameterWebApplication;
use Yii;

trait ApplicationAwareTrait
{
    public function getApp() : DameterConsoleApplication|DameterWebApplication
    {
        /** @var DameterConsoleApplication|DameterWebApplication $app */
        $app =  Yii::$app;
        return $app;
    }

    public function getWebApp() : DameterWebApplication
    {
        $app = $this->getApp();
        if($app instanceof DameterWebApplication) {
            return $app;
        }
        throw new FlomtaException("invalid app type");
    }

    public function isConsoleApp() : bool
    {
        return $this->getApp() instanceof DameterConsoleApplication;
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