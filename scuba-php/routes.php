<?php
function guest_routes(){
    switch ($_GET["page"]){
        case "register":
            do_register();
            break;        
        case "forget-password":
            do_forget();
            break;
        case "change_password":
            do_change_password();
            break;
        case "mail-validation":
            do_validation($_GET['token']);
            break;
        case "not_found":
            do_not_found();
            break;
        case "forget-password":
            do_forget_password();
            break;
        case "change-password":
            do_change_password();
            break;
        default:
            do_login();
            break;
    }
}

function auth_routes(){
    switch ($_GET['page']) {
        case "logout":
            do_logout();
            break;
        case "delete-account":
            do_delete_account();
            break;
        default:
            do_home();
            break;
    }
}