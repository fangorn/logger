<?php

namespace Fangorn;

use PHPUnit\Framework\TestCase;
use Fangorn\Handler\FileHandler;
use Fangorn\Handler\SyslogHandler;

class LoggerTest extends TestCase {
    public function testFileLog(): void {

        $applicationName = 'test-application';
        $salt            = rand(1, 10000);
        $warningMessage  = 'Log warning string ' . $salt;
        $errorMessage    = 'Log error string ' . $salt;

        $log = new Logger($applicationName);
        $log->addHandler(new FileHandler('./local/tmp/mylog.log'));

        $log->warning($warningMessage);
        $log->error($errorMessage);

        $fileContent = file_get_contents('./local/tmp/mylog.log');
        assertEquals(substr_count($fileContent, $warningMessage), 1);
        assertEquals(substr_count($fileContent, $errorMessage), 1);
    }

    public function testSyslog(): void {

        $applicationName = 'test-application';
        $salt            = rand(1, 10000);
        $message         = 'test message ' . $salt;

        $logger = new Logger($applicationName);
        $logger->addHandler(new SyslogHandler($applicationName));
        $logger->warning($message);

        $cmd    = 'cat /var/log/syslog | grep ' . escapeshellarg($applicationName);
        $output = shell_exec($cmd);
        assertContains("test-application: {$message}", $output);
    }

    public function testSeveralHandlers(): void {

        $applicationName = 'test-application';
        $salt            = rand(1, 10000);
        $message         = 'test message ' . $salt;

        $logger = new Logger($applicationName);
        $logger->addHandler(new SyslogHandler($applicationName));
        $logger->addHandler(new FileHandler('./local/tmp/mylog.log'));
        $logger->info($message);

        $cmd    = 'cat /var/log/syslog | grep ' . escapeshellarg($applicationName);
        $output = shell_exec($cmd);
        $fileContent = file_get_contents('./local/tmp/mylog.log');
        assertContains($applicationName . ": " . $message, $output);
        assertEquals(substr_count($fileContent, $message), 1);
    }
}
