<?php

class SyslogHandler {

    function __construct()
    {
        openlog($this->applicationName, LOG_CONS, LOG_USER);
    }

    function __destruct()
    {
        closelog();
    }
}