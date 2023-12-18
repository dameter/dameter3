<?php
namespace dameter\app\factories;

use dameter\app\models\Respondent;
use dameter\app\models\Response;
use dameter\app\models\Status;
use dameter\app\traits\ApplicationAwareTrait;
use Ramsey\Uuid\Uuid;
use dameter\app\exceptions\DameterException;
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
        throw new DameterException("Error saving response: ". json_encode($model->errors));

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