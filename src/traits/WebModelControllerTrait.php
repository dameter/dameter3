<?php

namespace respund\collector\traits;

use respund\collector\exceptions\RespundException;
use respund\collector\models\ActiveRecord;
use respund\collector\models\KeyedModelInterface;
use respund\collector\models\Respondent;
use respund\collector\models\Survey;
use respund\collector\models\UuidModelInterface;
use yii\web\NotFoundHttpException;

trait WebModelControllerTrait
{

    protected function findSurvey(mixed $key) : Survey
    {
        /** @var Survey $model */
        $model = $this->findModelByKey($key, Survey::class);
        return $model;
    }

    protected function findRespondent(mixed $key) : Respondent
    {
        /** @var Respondent $model */
        $model = $this->findModelByKey($key, Respondent::class);
        return $model;
    }

    protected function findModelByUuid(mixed $uuid, string $className) : ActiveRecord
    {
        if(empty($uuid) or (!is_string($uuid) and !is_numeric($uuid))) {
            throw new RespundException("invalid uuid");
        }
        /** @var UuidModelInterface $model */
        $model = \Yii::createObject($className);
        $model = $model->findByUuid((string) $uuid);

        if(!($model instanceof ActiveRecord)) {
            throw new NotFoundHttpException("Model not found!");
        }
        return $model;

    }


    protected function findModelByKey(mixed $key, string $className) : ActiveRecord
    {
        if(empty($key) or (!is_string($key) and !is_numeric($key))) {
            throw new RespundException("invalid key");
        }

        /** @var KeyedModelInterface $model */
        $model = \Yii::createObject($className);
        $model = $model->findByKey((string) $key);

        if(!($model instanceof ActiveRecord)) {
            throw new NotFoundHttpException("Model not found!");
        }
        return $model;

    }

}