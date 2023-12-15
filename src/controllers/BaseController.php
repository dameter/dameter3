<?php

namespace dameter\app\controllers;

use dameter\app\exceptions\DameterException;
use yii\web\Controller;
use yii\web\Request;

class BaseController extends Controller
{
    protected array $viewParams = [];

    protected function request() : Request
    {
        if($this->request instanceof Request) {
            return $this->request;
        }
        throw new DameterException("invalid request");
    }

}