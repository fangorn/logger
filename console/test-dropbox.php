<?php

use Fangorn\Handler\DropboxHandler;
use Fangorn\Logger;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dropboxAuthToken = $argv[1] ?? null;
$testMessage      = $argv[2] ?? 'test debug message';

$logger = new Logger('test');

$dropbox = new DropboxHandler($dropboxAuthToken);
$logger->addHandler($dropbox);

$logger->debug($testMessage);




