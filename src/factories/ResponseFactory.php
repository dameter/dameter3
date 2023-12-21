<?php
declare(strict_types=1);

namespace respund\collector\factories;

use respund\collector\models\Respondent;
use respund\collector\models\Response;
use respund\collector\models\ResponseData;
use respund\collector\models\Status;
use respund\collector\traits\ApplicationAwareTrait;
use Ramsey\Uuid\Uuid;
use respund\collector\exceptions\RespundException;
use yii\helpers\Json;

class ResponseFactory
{
    use ApplicationAwareTrait;

    /**
     * @param Respondent $respondent
     * @param array<string, mixed> $data
     * @return Response
     * @throws RespundException
     */
    public function make(Respondent $respondent, array $data) : Response
    {

        $model = $this->findExisting($respondent);
        if(empty($model)) {
            $model = $this->makeNew($respondent);
        }

        return $this->saveData($model, $data);

    }

    /**
     * @param Response $response
     * @param array<string, mixed> $data
     * @return Response
     * @throws RespundException
     */
    public function saveData(Response $response, array $data) : Response
    {
        $currentData = $response->dataDecoded();
        if(!empty($data)) {
            $this->getApp()->debug("got-response-data", []);

            /** @var array<string|int,string|int|float>  $attributes */
            $attributes = $currentData[ResponseData::ATTRIBUTES];

            $currentData[ResponseData::COL_PAGE_NR] = intval($data[ResponseData::COL_PAGE_NR]);
            /** @var array<string, string|int|float> $pageData */
            $pageData = $data['pageData'];

            foreach ($pageData as $key => $value) {
                $this->getApp()->debug("saving item $key");
                if(is_numeric($value)) {
                    // convert to numeric
                    $value = $value +0;
                }
                $attributes[$key] = $value;
            }
            $currentData[ResponseData::ATTRIBUTES] = $attributes;

        } else {
            $this->getApp()->debug("got-empty-response");
        }

        $response->data = Json::encode($currentData);

        if($response->save()) {
            $this->getApp()->info("saved-response-data", $currentData);
            return $response;
        }
        throw new RespundException("Error saving response: ". json_encode($response->errors));

    }

    private function findExisting(Respondent $respondent) : ?Response
    {
        return $respondent->response;

    }

    private function makeNew(Respondent $respondent) : Response
    {

        $recordNr = intval($respondent->survey->getResponses()->count()) + 1;
        $params = [
            'survey_id' => $respondent->survey_id,
            'respondent_id' => $respondent->primaryKey,
            'uuid' => Uuid::uuid4()->toString(),
            'status_id' => Status::CREATED,
            'nr' => $recordNr,
            'data' => json_encode([
                ResponseData::COL_TIME_CREATED => $this->currentTimeForDb(),
                ResponseData::COL_PAGE_NR => 0,
                ResponseData::ATTRIBUTES => [],
            ])
        ];
        $this->getApp()->info("new response", $params);
        return new Response($params);

    }


}