<?php

namespace Fangorn;

use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface {

    /** @var string */
    private $applicationName;

    /** @var array */
    private $handlers;

    function __construct(string $applicationName) {
        $this->applicationName = $applicationName;
        $this->handlers = [];
    }

    public function addHandler($handler): void {
        if (!method_exists($handler, writeToLog)) {
            throw new Exception('Unable use metod writeToLog');
        }

        if (isset($handler) && $handler != null) {
            array_push($this->handlers, $handler);
        }
    }

    public function alert($message, array $context = []): void {
        foreach ($this->handlers as $handler) {
            $handler->writeToLog($message, LOG_ALERT);
        }
    }

    public function critical($message, array $context = []): void {
        foreach ($this->handlers as $handler) {
            $handler->writeToLog($message, LOG_CRIT);
        }
    }

    public function debug($message, array $context = []): void {
        foreach ($this->handlers as $handler) {
            $handler->writeToLog($message, LOG_DEBUG);
        }
    }

    public function emergency($message, array $context = []): void {
        foreach ($this->handlers as $handler) {
            $handler->writeToLog($message, LOG_EMERG);
        }
    }

    public function error($message, array $context = []): void {
        foreach ($this->handlers as $handler) {
            $handler->writeToLog($message, LOG_ERR);
        }
    }

    public function info($message, array $context = []): void {
        foreach ($this->handlers as $handler) {
            $handler->writeToLog($message, LOG_INFO);
        }
    }

    public function log($level, $message, array $context = []): void {
        foreach ($this->handlers as $handler) {
            $handler->writeToLog($message, $level);
        }
    }

    public function notice($message, array $context = []): void {
        foreach ($this->handlers as $handler) {
            $handler->writeToLog($message, LOG_NOTICE);
        }
    }

    public function warning($message, array $context = []): void {
        foreach ($this->handlers as $handler) {
            $handler->writeToLog($message, LOG_WARNING);
        }
    }
}
