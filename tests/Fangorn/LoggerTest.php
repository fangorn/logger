<?php

namespace Fangorn;

use PHPUnit\Framework\TestCase;
use Fangorn\Logger;
use Fangorn\Handler\FileHandler;
use Fangorn\Handler\SyslogHandler;

class LoggerTest extends TestCase {
    public function testStub(): void {

        $applicationName = 'application';

        $log = new Logger($applicationName);
        $log->addHandler(new FileHandler('/mylog.log'));
        $log->addHandler(new SyslogHandler($applicationName));

        $log->warning('Log warning string');
        $log->error('Log error string');

        assertTrue(true);
    }
}
