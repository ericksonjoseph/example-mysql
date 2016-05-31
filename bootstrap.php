<?php

// Bootstrap

try {
    $PDO = new PDO('mysql:host=192.168.99.100;port=3306;dbname=test;', 'root', 'root', array(PDO::ATTR_TIMEOUT => '1'));
} catch (\PDOException $e) {
    echo $e->getMessage() . PHP_EOL . PHP_EOL;
    throw $e;
}
