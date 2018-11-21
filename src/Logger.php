<?php

require_once '../vendor/autoload.php';

use Psr\Log\LoggerInterface;


class Logger implements LoggerInterface {

    /** @var string $applicationName  */
    private $applicationName;

    /** @var ?FileHandler $fileHandler */
    private $fileHandler = null;

    /** @var ?SyslogHandler $sysLogHandler */
    private $sysLogHandler = null;

    function __construct($applicationName)
    {
        $this->applicationName = $applicationName;
    }

    /**
     * @param FileHandler $handler
     */
    public function addHandler($handler):void {

        if ($handler instanceof FileHandler) {
            $this->fileHandler = $handler;
            return;
        }
        $this->sysLogHandler = $handler;
    }

    public function alert($message, array $context = array())
    {
        $this->fileHandler->writeToLogFile($message, LOG_ALERT);
        syslog(LOG_ALERT, $message);
    }

    public function critical($message, array $context = array())
    {
        $this->fileHandler->writeToLogFile($message, LOG_CRIT);
        syslog(LOG_CRIT, $message);
    }

    public function debug($message, array $context = array())
    {
        $this->fileHandler->writeToLogFile($message, LOG_DEBUG);
        syslog(LOG_DEBUG, $message);
    }

    public function emergency($message, array $context = array())
    {
        $this->fileHandler->writeToLogFile($message, LOG_EMERG);
        syslog(LOG_EMERG, $message);
    }

    public function error($message, array $context = array())
    {
        $this->fileHandler->writeToLogFile($message, LOG_ERR);
        syslog(LOG_ERR, $message);
    }

    public function info($message, array $context = array())
    {
        $this->fileHandler->writeToLogFile($message, LOG_INFO);
        syslog(LOG_INFO, $message);
    }

    public function log($level, $message, array $context = array())
    {
        $this->fileHandler->writeToLogFile($message, $level);
        syslog($level, $message);
    }

    public function notice($message, array $context = array())
    {
        $this->fileHandler->writeToLogFile($message, LOG_NOTICE);
        syslog(LOG_NOTICE, $message);
    }

    public function warning($message, array $context = array())
    {
        $this->fileHandler->writeToLogFile($message, LOG_WARNING);
        syslog(LOG_WARNING, $message);
    }
}