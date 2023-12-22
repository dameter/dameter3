<?php

namespace respund\collector\models;

use yii\data\ActiveDataProvider;

interface SearchInterface
{
    /**
     * Creates data provider instance with search query applied
     *
     * @param array<string, mixed> $params
     */
    public function search(array $params) : ActiveDataProvider;

}