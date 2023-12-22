<?php

namespace respund\collector\models;
/**
 * @property string $key
 */
interface KeyedModelInterface
{
    public function findByKey(string $key) : ?self;
}