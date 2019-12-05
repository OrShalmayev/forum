<?php
namespace Config;

// Start session
session_start();

use App\Helpers\AppHelper;
use App\Lib\Database;

// Auto load files.
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// Declare user details in session
if(!isset($_SESSION['visitor_details']) && empty($_SESSION['visitor_details'])){
    // first check in cookies if user has been blocked.
    if(isset($_COOKIE['blocked'])){
        die('You have been blocked.');
    }
    // second check with the database if visitor have been blocked.
    $stmt = Database::connect()->prepare('SELECT * FROM blocked WHERE ip=:ip LIMIT 1');
    $stmt->execute([
        'ip'=>AppHelper::get_client_ip()
    ]);
    if($stmt->rowCount() > 0){
        // user has been blocked.
        die('You have been blocked.');
    }

    $_SESSION['visitor_details'] = [
        'ip' => AppHelper::get_client_ip(),
        'REQUEST_TIME' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']),
        'manipulator' => 0
    ];
}

// if the user is manipulating the url then dont allow him to connect
if($_SESSION['visitor_details']['manipulator'] > 2){
    // set a cookie that expires in 10 years
    setcookie('blocked', 1, time() + (10 * 365 * 24 * 60 * 60));
    // save in the databas users ip
    $stmt = Database::connect()->prepare('INSERT INTO blocked(ip) VALUES(:ip)');
    $stmt->execute([
        'ip' => AppHelper::get_client_ip()
    ]);
    die('You have been blocked');
}

// Database Variables
define('DB_USER', 'root');
define('DB_PASS', '');
define('DSN', 'mysql:host=localhost;dbname=forum');

// Usefull variables
define('APP_ROOT', dirname(dirname(dirname(__FILE__))));
define('URL_ROOT', 'http://localhost/forum/');
define('WEB_NAME', 'Learn Dev');
define('WEB_CREATOR', 'Or Shalmayev');
define('CURRENT_YEAR', date('Y'));

define('USERNAME_IS_EMPTY_MSG', 'Username must be filled correctly');
define('EMAIL_IS_EMPTY_MSG', 'Email must be filled correctly');
define('PASSWORD_IS_EMPTY_MSG', 'Password must be filled correctly');
define('USER_NOT_EXISTS', 'User does not exists.');