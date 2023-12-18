<?php
namespace respund\collector\factories;

use respund\collector\models\Respondent;
use respund\collector\models\Response;
use respund\collector\models\Status;
use respund\collector\traits\ApplicationAwareTrait;
use Ramsey\Uuid\Uuid;
use respund\collector\exceptions\RespundException;
use yii\helpers\Json;

class ResponseFactory
{
    use ApplicationAwareTrait;

    public function make(Respondent $respondent, array $data) : Response
    {

        $model = $this->findExisting($respondent);
        if(empty($model)) {
            $this->makeNew($respondent);
        }
        $currentData = $model->dataDecoded();
        foreach ($data as $key => $value) {
            if(is_numeric($value)) {
                // convert to numeric
                $value = $value +0;
            }
            $currentData[$key] = $value;
        }
        $model->data = Json::encode($currentData);
        if($model->save()) {
            return $model;
        }
        throw new RespundException("Error saving response: ". json_encode($model->errors));

    }

    private function findExisting(Respondent $respondent) : ?Response
    {
        return $respondent->response;

    }

    private function makeNew(Respondent $respondent) : Response
    {

        $params = [
            'survey_id' => $respondent->survey_id,
            'respondent_id' => $respondent->primaryKey,
            'uuid' => Uuid::uuid4()->toString(),
            'status_id' => Status::CREATED,
            'nr' => 1,
        ];
        $this->getApp()->info("new response", $params);
        return new Response($params);

    }

}