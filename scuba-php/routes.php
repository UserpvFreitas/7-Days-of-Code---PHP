<?php

switch ($_GET["page"]){
    case "register":
        do_register();
        break;
    case "login":
        do_login();
        break;
    case "forget-password":
        do_forget();
        break;
    case "change_password":
        do_change_password();
        break;
    default:
        do_not_found();
        break;
}