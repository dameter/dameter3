<?php

namespace dameter\app;

interface ApplicationInterface
{
    public function log(string $logLevel, string $message, array $context = [], string $level = 'info') : void;
    public function info(string $message, array $context = []) : void;
    public function error(string $message, array $context = []) : void;
    public function debug(string $message, array $context = []) : void;
    public function warning(string $message, array $context = []) : void;


}