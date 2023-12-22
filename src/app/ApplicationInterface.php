<?php
declare(strict_types=1);

namespace respund\collector\app;

interface ApplicationInterface
{
    /**
     * @param string $logLevel
     * @param string $message
     * @param array<string,mixed> $context
     * @param string $level
     * @return void
     */
    public function log(string $logLevel, string $message, array $context = [], string $level = 'info') : void;

    /**
     * @param string $message
     * @param array<string,mixed> $context
     * @return void
     */
    public function info(string $message, array $context = []) : void;

    /**
     * @param string $message
     * @param array<string,mixed> $context
     * @return void
     */
    public function error(string $message, array $context = []) : void;

    /**
     * @param string $message
     * @param array<string,mixed> $context
     * @return void
     */
    public function debug(string $message, array $context = []) : void;

    /**
     * @param string $message
     * @param array<string,mixed> $context
     * @return void
     */
    public function warning(string $message, array $context = []) : void;


}