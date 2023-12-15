<?php

namespace dameter\app\traits;

use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * @property string $uuid
 * @property string $key
 */
trait KeyedRecordTrait
{
    public function findByKey(string $key) : ?self
    {
        /** @var ActiveQuery $query */
        $query = $this->find();
        $query->andWhere(\Yii::$app->db->quoteColumnName('key').'=:key', [":key" => trim($key)]);
        $model = $query->one();

        if($model instanceof static) {
            return  $model;
        }
        return null;
    }
    
    public function findByUuid(string $uuid) : ?self
    {
        /** @var ActiveQuery $query */
        $query = $this->find();
        $query->andWhere(\Yii::$app->db->quoteColumnName('uuid').'=:uuid', [":uuid" => trim($uuid)]);
        $model = $query->one();
        if($model instanceof static) {
            return  $model;
        }
        return null;
    }

}