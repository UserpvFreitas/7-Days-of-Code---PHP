<?php
session_start();
include 'boot.php';

//unset($_SESSION['user']);
if(auth_user() != null){
    auth_routes();
}else{
    guest_routes();
}
