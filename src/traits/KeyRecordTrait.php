<?php

namespace respund\collector\traits;

use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * @property string $uuid
 * @property string $key
 */
trait KeyRecordTrait
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
}