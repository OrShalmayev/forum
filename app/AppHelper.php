<?php

class AppHelper{
    
    const URL_ROOT = 'http://localhost/forum/';
    const WEB_NAME = 'My Forum';
    const WEB_CREATOR = 'Or Shalmayev';

    public function __construct()
    {

    }

    public function currentYear(){
        return date('Y');
    }

    public static function issetAndNotEmpty($var){
        if(isset($var) && !empty($var)){
            return true;
        }else{
            return false;
        }
    }

    public static function errorMsgRedirect($msg, $redirect = null){
        $_SESSION['error_msg'] = $msg;

        if(!$redirect){
            self::redirect();
        }else{
            self::redirect($redirect);
        }
    }

    public static function redirect($to=null, $msg=null, $typeofMsg = 'success_msg'){
        if($msg){
            $_SESSION[$typeofMsg] = $msg;
        }
        if($to){
            return header('Location:'.self::URL_ROOT . '?page='.$to);
        }else{
            return header('Location:'.self::URL_ROOT);
        }
    }
}

// die dump
function dd($var){
    return die(print_r($var));
}

$helper =  new AppHelper();