<?php
// require database
require('./Database.php');
require('./AppHelper.php');

/*
    #1) Check if POST method has been requested
    #2) check if the previous url was actually the login url 
 */
if($_SERVER['REQUEST_METHOD']=='POST' && $_SERVER['HTTP_REFERER']== $helper::URL_ROOT.'?page=login'){
    // Declaring variables
    $isValid = false; // determines if all the data is valid.
    $user = []; // here will be all the user data that has been submitted in the form
    // check if fields empty
    foreach ($_POST as $key => $value) {
        // check if the posted data is set and not empty.
        if($helper::issetAndNotEmpty($_POST[$key])){
            // clean posted data
            if($key=='e'){
                // if email filter
                $user['e'] = filter_var($_POST[$key], FILTER_SANITIZE_EMAIL);
            }else{
                // filer password
                $user['p'] = preg_replace('/[^a-zA-Z0-9]/', '', $_POST[$key]);
            }

        }else{
            // some data empty..
            // redirect and send error message.
            if($key=='e'){
                $isValid = false;
                // email is empty
                return $helper::errorMsgRedirect(EMAIL_IS_EMPTY_MSG, 'login');
            }else if($key=='p'){
                $isValid = false;
                // password is empty
                return $helper::errorMsgRedirect(PASSWORD_IS_EMPTY_MSG, 'login');
            }
        }
    }// end foreach

    // if the code came to here then there is no error.
    $isValid = true;
    // Do some mmore validations ?

    // if everything is valid then search for the user in the database.
    if($isValid){
        $stmt = $db->prepare("SELECT * FROM users WHERE email=:email AND password=:password LIMIT 1");
        $stmt->execute([
            'email'=> $user['e'],
            'password'=> $user['p']
        ]);

        if($stmt->rowCount() > 0){
            $userExists = $stmt->fetch();
            // if we found the user then save some data in the session and update the user last_login column
            $_SESSION['user'] = [
                
            ];

        }else{
            // user not found send error message that the user is not exists
            $helper::errorMsgRedirect(USER_NOT_EXISTS, 'login')
        }
    }



}else{
    // either POST method not been requested or the previous url wasnt the login url
    // then redirect to login page
    $helper::redirect('login');
}
