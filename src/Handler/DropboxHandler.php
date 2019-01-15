<?php

namespace Fangorn\Handler;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;

class DropboxHandler implements HandlerInterface {

    /** @var Client */
    private $client;

    /** @var DropboxAdapter */
    private $adapter;

    /** @var Filesystem */
    private $fileSystem;

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

    public function __construct(string $authorizationToken, string $pathToLogFile = './mylog.log') {
        $this->client        = new Client($authorizationToken);
        $this->adapter       = new DropboxAdapter($this->client);
        $this->fileSystem    = new Filesystem($this->adapter);
        $this->pathToLogFile = $pathToLogFile;
    }

    public function writeToLog(string $message, int $priority): void {
        $previousContent  = '';
        $fullLogMessage   = self::$priorityNames[$priority] . ' ' . date('[Y-m-d H:i:s] ') . ': ' . $message . PHP_EOL;

        if ($this->fileSystem->has($this->pathToLogFile)) {
            $previousContent = $this->fileSystem->readAndDelete($this->pathToLogFile);
        }

        $this->fileSystem->put($this->pathToLogFile, $previousContent . PHP_EOL . $fullLogMessage);
    }
}
