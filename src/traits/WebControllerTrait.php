<?php
declare(strict_types=1);

namespace respund\collector\traits;

use respund\collector\exceptions\RespundException;
use yii\web\Request;
use yii\web\Response;

trait WebControllerTrait
{

    protected function request() : Request
    {
        if($this->request instanceof Request) {
            return $this->request;
        }
        throw new RespundException("invalid request");
    }

    public function response(): Response
    {
        $response = \Yii::$app->response;
        if($response instanceof Response) {
            return $response;
        }

        throw new RespundException("Invalid Response");
    }

}