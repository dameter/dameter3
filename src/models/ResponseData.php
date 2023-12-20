<?php
declare(strict_types=1);

namespace respund\collector\models;

use yii\base\DynamicModel;

class ResponseData extends DynamicModel
{
    const COL_TIME_CREATED = "timeCreated";
    const COL_PAGE_NR = 'currentPageNo';
    const ATTRIBUTES = 'attributes';

    public string $timeCreated = "";

}