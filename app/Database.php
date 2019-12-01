<?php
define('APP_ROOT', dirname(dirname(__FILE__)));
require(APP_ROOT.'/app/config.php');

class Database{
    private $connect;

    public function __construct()
    {
        try {

            $this->connect = new PDO(DSN, DB_USER, DB_PASS);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        } catch (\PDOException $e) {
            die($e->getMessage());
        }

    }
}

$db = new Database();