<?php

namespace dameter\app\controllers;

use dameter\app\models\Survey;

class SurveyController extends BaseController
{
    public function actionIndex() {
        $request = $this->request();
        $key = $request->get('key');
        $model = (new Survey())->findByKey($key);
        $this->viewParams['model'] = $model;
        return $this->render('index', $this->viewParams);
    }

}