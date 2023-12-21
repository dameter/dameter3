<?php
declare(strict_types=1);

namespace respund\collector\models;

use respund\collector\traits\UuidRecordTrait;
use yii\db\ActiveQuery;
use yii\helpers\Json;

/**
 * @property int $response_id
 * @property int $nr sequence nr within one survey
 * @property string $uuid
 * @property int $status_id
 * @property string $data response data in json
 * @property Respondent $respondent
 */
class Response extends TimedActiveRecord
{
    use UuidRecordTrait;

    public function rules() : array
    {
        return array_merge(parent::rules(),[
            [['nr', 'respondent_id'], 'required'],
            [['uuid'], 'string', 'max' => 45],
            [['uuid'], 'unique'],
            [['nr'], 'number'],
            [['status_id'], 'integer'],
            [['survey_id'], 'integer'],
            [['respondent_id'], 'integer'],

            [['data'], 'string'],
            [['time_completed'], 'string', 'max' => self::TIME_COL_LENGTH],

        ]);
    }

    /**
     * @return array<string,array|mixed>
     */
    public function dataDecoded() : array
    {

        /** @var array<string,array|mixed> $data */
        $data = Json::decode($this->data);
        if(empty($data)) {
            $data = [];
        }
        return $data;
    }

    public function getRespondent(): ActiveQuery
    {
        return $this->hasOne(Respondent::class, ['respondent_id' => 'respondent_id']);
    }

    public function pageNumber() : int
    {
        $data = $this->dataDecoded();
        if(isset($data[ResponseData::COL_PAGE_NR])) {

            /** @var string|int $rawValue */
            $rawValue = $data[ResponseData::COL_PAGE_NR];
            return intval($rawValue);
        }
        return 0;
    }

    /**
     * @return array<string, mixed>
     */
    public function currentData() : array
    {
        $data = $this->dataDecoded();
        if(isset($data[ResponseData::ATTRIBUTES])) {
            /** @var array<string, mixed> $out */
            $out = $data[ResponseData::ATTRIBUTES];
            return $out;
        }
        return [];
    }



}