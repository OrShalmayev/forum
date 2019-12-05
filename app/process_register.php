<?php
// require database

use App\Lib\Database;
use App\Helpers\AppHelper;
use App\Helpers\Validator;

require('lib/Database.php');
require('helpers/AppHelper.php');
require('helpers/Validator.php');

// check for the username availablity sent by ajax
if(isset($_POST['u']) && !empty($_POST['u']) && $_POST['action']=='check_username' ){
    // clean the string
    $u = AppHelper::cleanString($_POST['u']);
    // Validate username
    Validator::username($u);
}

// check for post and validate the the previous url was register
if($_SERVER['REQUEST_METHOD']=='POST' && $_SERVER['HTTP_REFERER'] == AppHelper::URL_ROOT.'?page=register' && !isset($_POST['action'])){
    $isValid = false;
    // Clean the string
    $user = [];
    foreach($_POST as $key=>$value){
        if($key=='e'){
            // if email then do email filters
            $user[$key] = filter_var($_POST[$key], FILTER_SANITIZE_EMAIL);
        }else{
            $user[$key] = preg_replace('/[^a-zA-Z0-9.]/', '', $_POST[$key]);
        }
    }
    foreach ($user as $key => $value) {
        if(AppHelper::issetAndNotEmpty($user[$key])){
            // username email and password not empty
            // do more validations as you want ...
            $isValid = true;

        }else{
            if($key=='un'){
                $isValid = false;
                return AppHelper::errorMsgRedirect('Username is not filled correctly.', 'register');
            }else if($key=='e'){
                $isValid = false;
                return AppHelper::errorMsgRedirect('Email is not filled correctly.', 'register');
            }else if($key=='p'){
                $isValid = false;
                return AppHelper::errorMsgRedirect('password is not filled correctly.', 'register');
            }
        }
    }

    // if all is valid then insert to table
    if($isValid){
        // after checking that all the fields are okay then insert the new user to users table
        // SQL for inserting the user

        // hash the user password
        $user['p'] = password_hash($user['p'], PASSWORD_DEFAULT);
        // get user ip and store it in a variable
        $user['ip'] = AppHelper::get_client_ip();

        // prepare the sql
        $stmt = Database::connect()->prepare("INSERT INTO users(username, email, password, ip) VALUES (:username, :email, :password, :ip)");
        // bind values
        $stmt->bindValue(':username', $user['un']);
        $stmt->bindValue(':email', $user['e']);
        $stmt->bindValue(':password', $user['p']);
        $stmt->bindValue(':ip', $user['ip']);
        // then execute the sql
        $stmt->execute();

        //  redirect to login page with success register message.
        return  AppHelper::redirect('login','Registered Successfully!');
    }

}else{
    // user came to this file by mistake or trying to hack..
    AppHelper::redirect();
}