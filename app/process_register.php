<?php
// require database
require('./Database.php');
require('./AppHelper.php');
// check for post and validate the the previous url was register
if($_SERVER['REQUEST_METHOD']=='POST' && $_SERVER['HTTP_REFERER'] == $helper::URL_ROOT.'?page=register'){
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
        if($helper::issetAndNotEmpty($user[$key])){
            // username email and password not empty
            // do more validations as you want ...
            $isValid = true;

        }else{
            if($key=='un'){
                $isValid = false;
                return $helper::errorMsgRedirect('Username is not filled correctly.', 'register');
            }else if($key=='e'){
                $isValid = false;
                return $helper::errorMsgRedirect('Email is not filled correctly.', 'register');
            }else if($key=='p'){
                $isValid = false;
                return $helper::errorMsgRedirect('password is not filled correctly.', 'register');
            }
        }
    }

    // if all is valid then insert to table
    if($isValid){
        // after checking that all the fields are okay then insert the new user to users table
        // SQL for inserting the user

        // prepare the sql
        $stmt = $db->prepare("INSERT INTO users(username, email, password) VALUES (:username, :email, :password)");
        // bind values
        $stmt->bindValue(':username', $user['un']);
        $stmt->bindValue(':email', $user['e']);
        $stmt->bindValue(':password', $user['p']);
        // then execute the sql
        $stmt->execute();

        //  redirect to login page with success register message.
        return  $helper::redirect('login','Registered Successfully!');
    }

}else{
    // user came to this file by mistake or trying to hack..
    $helper::redirect();
}