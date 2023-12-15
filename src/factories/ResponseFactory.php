<?php
namespace dameter\app\factories;

use dameter\app\models\Respondent;
use dameter\app\models\Response;
use dameter\app\models\Status;
use dameter\app\traits\ApplicationAwareTrait;
use Ramsey\Uuid\Uuid;
use dameter\app\exceptions\DameterException;

class ResponseFactory
{
    use ApplicationAwareTrait;

    public function make(Respondent $respondent, array $data)
    {
        $model = $this->makeNew($respondent, $data);
        return $model;

    }

    private function makeNew(Respondent $respondent, array $data) : Response
    {

        $params = [
            'survey_id' => $respondent->survey_id,
            'respondent_id' => $respondent->primaryKey,
            'uuid' => Uuid::uuid4()->toString(),
            'status_id' => Status::CREATED,
            'nr' => 1,
        ];
        $this->getApp()->info("new response", $params);
        $model = new Response($params);

        if($model->save()) {
            return $model;
        }
        throw new DameterException("Error saving response: ". json_encode($model->errors));
    }

}