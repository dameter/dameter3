<?php

namespace dameter\app\controllers;

use yii\web\Controller;
use Yii;

class SurveyController extends Controller
{
    public function actionIndex() {
        return $this->render('index');
    }

}