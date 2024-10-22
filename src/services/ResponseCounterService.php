<?php

namespace respund\collector\services;

use respund\collector\models\Response;
use respund\collector\models\Survey;
use yii\db\ActiveQuery;
use yii\db\ArrayExpression;
use yii\db\JsonExpression;

class ResponseCounterService
{
    private int $count = 0;

    public function __construct(private readonly Survey $survey)
    {
    }

    public function run() : void
    {
        $query =$this->query();
        $this->count = $query->count();
    }

    public function getCount() : int
    {
        return $this->count;
    }

    private function query(): ActiveQuery
    {
        $query = $this->survey->getResponses()
            // TODO a basic example of json filtering
            ->andWhere("JSON_EXTRACT(data, '$.attributes.source') = 1")
        ;
        return $query;
    }

}