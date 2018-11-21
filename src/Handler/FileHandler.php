<?php

class FileHandler {

    /** @var string */
    private $pathToLogFile;

    /** @param string $pathToLogFile */
    function __construct($pathToLogFile)
    {
        $this->pathToLogFile = $pathToLogFile;
    }

    public function getPathToLogFile(): string {
        return $this->pathToLogFile;
    }

    /** @param string $message
     *  @param int $priority
     */
    public function writeToLogFile($message, $priority): void {
        file_put_contents($this->pathToLogFile, $priority . ': ' . $message . PHP_EOL );
    }
}