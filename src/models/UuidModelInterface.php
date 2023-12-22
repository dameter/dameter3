<?php

namespace respund\collector\models;

interface UuidModelInterface
{
    public function findByUuid(string $uuid) : ?self;

}