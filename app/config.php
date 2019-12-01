<?php
// Start session
session_start();

// Declare user details in session
if(!isset($_SESSION['visitor_details']) && empty($_SESSION['visitor_details'])){
    $_SESSION['visitor_details'] = [
        'ip' => $_SERVER['REMOTE_ADDR'],
        'REQUEST_TIME' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']),
    ];
}

// Database Variables
define('DB_USER', 'root');
define('DB_PASS', '');
define('DSN', 'mysql:host=localhost;dbname=forum');

// Usefull variables
define('URL_ROOT', 'http://localhost/forum/');
define('WEB_NAME', 'My Forum');
define('WEB_CREATOR', 'Or Shalmayev');
define('CURRENT_YEAR', date('Y'));

define('USERNAME_IS_EMPTY_MSG', 'Username must be filled correctly');
define('EMAIL_IS_EMPTY_MSG', 'Email must be filled correctly');
define('PASSWORD_IS_EMPTY_MSG', 'Password must be filled correctly');
define('USER_NOT_EXISTS', 'User does not exists.');