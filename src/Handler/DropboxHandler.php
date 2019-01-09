<?php

namespace Fangorn\Handler;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;

class DropboxHandler implements IHandler {

    private $client;
    private $adapter;
    private $fileSystem;

    public function __construct($authorizationToken) {
        $this->client     = new Client($authorizationToken);
        $this->adapter    = new DropboxAdapter($this->client);
        $this->fileSystem = new Filesystem($this->adapter);
    }

    public function writeToLog(string $message, int $priority): void {
        $previousContent  = '';
        $pathToRemoteLogs = './mylog.log';
        $fullLogMessage   = $priority . date('[Y-m-d H:i:s] ') . ': ' . $message . PHP_EOL;

        if ($this->fileSystem->has($pathToRemoteLogs)) {
            $previousContent = $this->fileSystem->readAndDelete($pathToRemoteLogs);
        }

        $this->fileSystem->put($pathToRemoteLogs, $previousContent . $fullLogMessage);
    }
}
