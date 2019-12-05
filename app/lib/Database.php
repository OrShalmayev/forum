<?php
namespace App\Lib;

use \PDO;


class Database{
    private static $user = 'root';
    private static $pass = '';
    private static $dbName = 'forum';
    private static $options = [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ
    ];
    
    // Internal variable to hold the connection
    private static $db;
    
    // No cloning or instantiating allowed
    final private function __construct() { }

    public static function connect() {
        if(is_null(self::$db)){
            try {
                self::$db = new PDO("mysql:host=localhost;dbname=".self::$dbName, self::$user, self::$pass, self::$options);
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$db;
    }
}


