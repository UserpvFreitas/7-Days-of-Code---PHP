<?php

function authentication($email, $password):bool{
    $user = crud_restore($email);

    if(($user['password'] == md5($password)) && $user['mail_validation']){
        $_SESSION = $user; 
        return true;               
    }

    return false;
} 

function auth_user(){
    return $_SESSION;
}

function auth_logout(){
    session_unset();
    header("Location: /");
}