<?php
const arquivo = ".\data\users.json";

function crud_create($user){
    $data = file_get_contents(arquivo);
    $data = json_decode($data);
    $data[] = $user;
    $data = json_encode($data);
    file_put_contents(arquivo, $data);
}

function check_email($email){
    return verifica_email($email);
}

function crud_do_validation($email){
    $data = file_get_contents(arquivo);
    $data = json_decode($data, true);

    foreach($data as $d){
        if($d['email'] == $email){
            return 'validou';
        } 
    }

    return false;
}