<?php

namespace Fangorn\Handler;

class FileHandler implements IHandler {

    /** @var string */
    private $pathToLogFile;

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
        file_put_contents($this->pathToLogFile, $priority . date('[Y-m-d H:i:s] ') . ': ' . $message . PHP_EOL, FILE_APPEND);
    }
}
