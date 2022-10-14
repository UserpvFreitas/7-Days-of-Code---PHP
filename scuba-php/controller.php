<?php

function do_register(){
    render_view("register.view");
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