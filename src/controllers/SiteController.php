<?php
declare(strict_types=1);

namespace respund\collector\controllers;

class SiteController extends BaseController
{

    /**
     * @return array<mixed>
     */
    public function actions() : array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() : string
    {
        return $this->render('index');
    }


}