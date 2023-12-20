<?php
declare(strict_types=1);

namespace respund\collector\traits;

use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * @property string $uuid
 * @property string $key
 */
trait UuidRecordTrait
{

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