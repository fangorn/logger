<?php

use PHPUnit\Framework\Assert;

require_once dirname(__DIR__) . '/vendor/autoload.php';

require_once dirname((new ReflectionClass(Assert::class))->getFileName()) . '/Assert/Functions.php';
