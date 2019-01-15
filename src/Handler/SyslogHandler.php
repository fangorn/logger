<?php

namespace Fangorn\Handler;

class SyslogHandler implements HandlerInterface {

    /** @var string */
    private $applicationName;

    public function __construct($applicationName)
    {
        $this->applicationName = $applicationName;
        openlog($this->applicationName, LOG_CONS, LOG_USER);
    }

    function __destruct()
    {
        closelog();
    }

    public function writeToLog(string $message, int $priority): void {
        syslog($priority, $message);
    }
}
