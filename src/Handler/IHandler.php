<?php

namespace Fangorn\Handler;

interface IHandler {
    public function writeToLog(string $message, int $priority): void;
}
