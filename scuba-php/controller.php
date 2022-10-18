<?php

function do_register(){
    if($_POST['person']  ?? false){
        unset($_POST['person']['password-confirm']);
        crud_create($_POST['person']);
        header("Location: /?page=login");
    }else{
        render_view("register.view");
    }
}

function do_login(){
    render_view("login.view");
}

function do_not_found(){
    render_view("not_found.view");
}

function do_forget(){
    render_view("forget_password.view");
}

function do_change_password(){
    render_view("change_password.view");
}

function save($user){
    crud_create($user);
}