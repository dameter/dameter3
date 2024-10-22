<?php
declare(strict_types=1);

namespace respund\collector\models;

use respund\collector\traits\KeyRecordTrait;
use respund\collector\traits\UuidRecordTrait;
use respund\collector\traits\WithStatusRecordTrait;
use yii\db\ActiveQuery;
use yii\helpers\Json;

/**
 * @property string $key
 * @property string $uuid
 * @property string $name
 * @property ?string $external_id
 * @property string $structure json surveyjs object
 */
class Survey extends TimedActiveRecord implements KeyedModelInterface, UuidModelInterface
{
    use UuidRecordTrait;
    use KeyRecordTrait;
    use WithStatusRecordTrait;

    public static function tableName() : string
    {
        return 'survey';
    }

    public function rules(): array
    {
        return array_merge(parent::rules(),[
            [['status_id', 'uuid','key'], 'required'],
            [['structure'], 'string'],
            [['key', 'uuid'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 255],
            [['status_id'], 'integer'],

        ]);
    }

    public function getRespondents(): ActiveQuery
    {
        return $this->hasMany(Respondent::class, ['survey_id' => 'survey_id'])
            ->indexBy('uuid');
    }

    public function getResponses(): ActiveQuery
    {
        return $this->hasMany(Response::class, ['survey_id' => 'survey_id'])
            ->indexBy('uuid');
    }


}
