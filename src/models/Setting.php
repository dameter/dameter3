<?php
declare(strict_types=1);

namespace respund\collector\models;

use respund\collector\traits\UuidRecordTrait;
use yii\db\ActiveQuery;

/**
 * @property int $setting_id
 * @property string $name
 * @property string $value
 */
class Setting extends ActiveRecord
{
    const KEY_LENGTH = "keyLength";

    /**
     * @return array<mixed>
     */
    public function rules() : array
    {
        return array_merge(parent::rules(),[
            [['name', 'value'], 'required'],
            [['name'], 'string', 'max' => 45],
        ]);
    }


    public function getRespondent(): ActiveQuery
    {
        return $this->hasOne(Respondent::class, ['respondent_id' => 'respondent_id']);
    }


    public function findByName(string $name) : ?static
    {
        $model =  $this->find()->where("name=:name", [":name" => $name])->one();
        if($model instanceof static) {
            return $model;
        }
        return null;
    }

}