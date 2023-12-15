<?php

namespace dameter\app\traits;

use dameter\app\DameterConsoleApplication;
use dameter\app\models\User;
use Psr\Log\LogLevel;
use Yii;

/**
 * @property array $params
 * @property string $logStreamName
 */
trait ApplicationTrait
{
    public ?User $identity = null;


    public function info(string $message, array $context = []) : void
    {
        $this->log(LogLevel::INFO, $message, $context);
        Yii::info(json_encode(['message' => $message, 'context' => $context], JSON_PRETTY_PRINT), 'flomta/app');
    }

    public function error(string $message, array $context = []) : void
    {
        $this->log(LogLevel::ERROR, $message, $context);
        Yii::error(json_encode(['message' => $message, 'context' => $context], JSON_PRETTY_PRINT), 'flomta/app');
    }

    public function debug(string $message, array $context = []) : void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
        Yii::debug(json_encode(['message' => $message, 'context' => $context], JSON_PRETTY_PRINT), 'flomta/app');
    }

    public function warning(string $message, array $context = []) : void
    {
        $this->log(LogLevel::WARNING, $message, $context);
        Yii::warning(json_encode(['message' => $message, 'context' => $context], JSON_PRETTY_PRINT), 'flomta/app');
    }


    public function log(string $logLevel, string $message, array $context = [], string $level = 'info') : void
    {
        if(!json_decode($message)) {
            $data = $message;
        } else {
            $data = json_decode($message, true);
        }
        if($this instanceof DameterConsoleApplication) {
            echo $message . PHP_EOL;
        }

        $this->logger->log($level, $data, $context);
    }


}