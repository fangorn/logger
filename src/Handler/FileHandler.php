<?php

namespace Fangorn\Handler;

class FileHandler implements HandlerInterface {

    /** @var string */
    private $pathToLogFile;

    /** @var array */
    private static $priorityNames = [
        LOG_EMERG   => 'EMERGENCY',
        LOG_ALERT   => 'ALERT',
        LOG_CRIT    => 'CRITICAL',
        LOG_ERR     => 'ERROR',
        LOG_WARNING => 'WARNING',
        LOG_NOTICE  => 'NOTICE',
        LOG_INFO    => 'INFO',
        LOG_DEBUG   => 'DEBUG',
        LOG_USER    => 'LOG',
    ];

    /**
     * @param string $pathToLogFile
     */
    public function __construct(string $pathToLogFile)
    {
        $this->pathToLogFile = $pathToLogFile;
    }

    public function getPathToLogFile(): string {
        return $this->pathToLogFile;
    }

    /**
     *  @param string $message
     *  @param int $priority
     */
    public function writeToLog(string $message, int $priority): void {
        file_put_contents($this->pathToLogFile, self::$priorityNames[$priority] . ' ' . date('[Y-m-d H:i:s] ') . ': ' . $message . PHP_EOL, FILE_APPEND);
    }
}
