<?php
declare(strict_types=1);

namespace respund\collector\controllers;

use respund\collector\exceptions\RespundException;
use respund\collector\models\Respondent;
use respund\collector\models\Survey;
use respund\collector\traits\ApplicationAwareTrait;
use respund\collector\traits\WebControllerTrait;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BaseController extends Controller
{
    use ApplicationAwareTrait;
    use WebControllerTrait;

    /**
     * @var array<string, mixed>
     */
    protected array $viewParams = [];

    protected function findSurvey(mixed $key) : Survey
    {
        if(empty($key) or (!is_string($key) and !is_numeric($key))) {
            throw new RespundException("invalid key");
        }
        $model = (new Survey())->findByKey((string) $key);
        if(!($model instanceof Survey)) {
            throw new NotFoundHttpException();
        }
        return $model;
    }

    protected function findRespondent(mixed $key) : Respondent
    {
        if(empty($key) or (!is_string($key) and !is_numeric($key))) {
            throw new RespundException("invalid key");
        }
        $model = (new Respondent())->findByKey((string) $key);
        if(!($model instanceof Respondent)) {
            throw new NotFoundHttpException();
        }
        return $model;
    }

}