<?php

class SyslogHandler {

    /** @var string */
    private $applicationName;

    function __construct($applicationName)
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
