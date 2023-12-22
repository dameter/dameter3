<?php
declare(strict_types=1);

namespace respund\collector\traits;

use respund\collector\app\RespundConsoleApplication;
use Psr\Log\LogLevel;
use Yii;

/**
 * @property array $params
 * @property string $logStreamName
 */
trait ApplicationTrait
{
    private string $logCategory = "respund\collector\app";


    public function info(string $message, array $context = []) : void
    {
        $this->log(LogLevel::INFO, $message, $context);
        /** @var string $messageWithContext */
        $messageWithContext = json_encode(['message' => $message, 'context' => $context], JSON_PRETTY_PRINT);
        Yii::info($messageWithContext, $this->logCategory);
    }

    public function error(string $message, array $context = []) : void
    {
        $this->log(LogLevel::ERROR, $message, $context);
        /** @var string $messageWithContext */
        $messageWithContext = json_encode(['message' => $message, 'context' => $context], JSON_PRETTY_PRINT);
        Yii::error($messageWithContext, $this->logCategory);
    }

    public function debug(string $message, array $context = []) : void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
        /** @var string $messageWithContext */
        $messageWithContext = json_encode(['message' => $message, 'context' => $context], JSON_PRETTY_PRINT);
        Yii::debug($messageWithContext, $this->logCategory);
    }

    public function warning(string $message, array $context = []) : void
    {
        $this->log(LogLevel::WARNING, $message, $context);
        /** @var string $messageWithContext */
        $messageWithContext = json_encode(['message' => $message, 'context' => $context], JSON_PRETTY_PRINT);
        Yii::warning($messageWithContext, $this->logCategory);
    }


    public function log(string $logLevel, string $message, array $context = [], string $level = 'info') : void
    {
        if(!json_decode($message)) {
            $data = $message;
        } else {
            $data = json_decode($message, true);
        }
        if($this instanceof RespundConsoleApplication) {
            echo $message . PHP_EOL;
        }

    }


}