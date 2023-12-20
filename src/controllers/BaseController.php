<?php
declare(strict_types=1);

namespace respund\collector\controllers;

use respund\collector\exceptions\RespundException;
use yii\web\Controller;
use yii\web\Request;

class BaseController extends Controller
{
    /**
     * @var array<string, mixed>
     */
    protected array $viewParams = [];

    protected function request() : Request
    {
        if($this->request instanceof Request) {
            return $this->request;
        }
        throw new RespundException("invalid request");
    }

}