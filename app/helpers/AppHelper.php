<?php
namespace App\Helpers;

use \App\Lib\Database;

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

    public static function cleanString($s){
        $s = preg_replace('/[^a-zA-Z0-9]/', '', $s);
        return $s;
    }

    
    public static function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }



}//end AppHelper class


// die dump
function dd($var){
    return die(print_r($var));
}
