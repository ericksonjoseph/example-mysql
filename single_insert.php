<?php
#!/bin/bash

include_once 'bootstrap.php';
include_once 'Utils.php';
include_once 'BenchmarkerTrait.php';
include_once 'Tester.php';

$opts = getOpt('bt');

if (isset($opts['b'])){
    echo 'inserting batch as one string' . PHP_EOL;
}

if (isset($opts['t'])){
    echo 'using tranasction' . PHP_EOL;
}

$T = new Tester($opts);

$T->stampTime();
$T->stampMemory();

$T->runTest();

$T->stampTime();
$T->stampMemory();

