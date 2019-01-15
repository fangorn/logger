<?php

namespace Fangorn;

use Exception;
use Fangorn\Handler\HandlerInterface;
use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface {

    /** @var string */
    private $applicationName;

    /** @var HandlerInterface[] */
    private $handlers;

    function __construct(string $applicationName) {
        $this->applicationName = $applicationName;
        $this->handlers = [];
    }

    public function addHandler(HandlerInterface $handler): void {
        $this->handlers[] = $handler;
    }

    private function writeToLog(string $message, int $priority): void {
        foreach ($this->handlers as $handler) {
            $handler->writeToLog($message, $priority);
        }
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function alert($message, array $context = []): void {
        $this->writeToLog($message, LOG_ALERT);
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function critical($message, array $context = []): void {
        $this->writeToLog($message, LOG_CRIT);
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function debug($message, array $context = []): void {
        $this->writeToLog($message, LOG_DEBUG);
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function emergency($message, array $context = []): void {
        $this->writeToLog($message, LOG_EMERG);
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function error($message, array $context = []): void {
        $this->writeToLog($message, LOG_ERR);
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function info($message, array $context = []): void {
        $this->writeToLog($message, LOG_INFO);
    }

    /**
     * @param int    $level
     * @param string $message
     * @param array  $context
     */
    public function log($level, $message, array $context = []): void {
        $this->writeToLog($message, $level);
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function notice($message, array $context = []): void {
        $this->writeToLog($message, LOG_NOTICE);
    }

    /**
     * @param string $message
     * @param array  $context
     */
    public function warning($message, array $context = []): void {
        $this->writeToLog($message, LOG_WARNING);
    }
}
