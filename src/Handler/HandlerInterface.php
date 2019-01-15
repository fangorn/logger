<?php

namespace Fangorn\Handler;

interface HandlerInterface {
    public function writeToLog(string $message, int $priority): void;
}
