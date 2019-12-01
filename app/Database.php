<?php
define('APP_ROOT', dirname(dirname(__FILE__)));
require(APP_ROOT.'/app/config.php');

$options = [
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ
];

try {
    $db = new PDO(DSN, DB_USER, DB_PASS, $options);
} catch (\PDOException $e) {
    die($e->getMessage());
}
