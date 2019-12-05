<?php
namespace App\Helpers;
use \App\Lib\Database;

class Validator{

    public static function username($username){
        // check if the first letter in username is numeric
        if(is_numeric($username[0])){
            die("Username must start with a letter.");
        }
        // check if the string length is less then 3 characters
        if(strlen($username) < 3 ){
            die("Username must contain at least 3 characters current: <mark>".strlen($username) . "</mark> characters.");
        }

        // ajax has been sent
        $db = Database::connect()->prepare('SELECT * FROM users WHERE username=:username LIMIT 1');

        $db->execute([
            'username'=> $username
        ]);

        if($db->rowCount() > 0){
            // username exists
            die('Username already taken.');
        }else{
            //username does not exists.
            die('Username can be used.');
        }
    }


}