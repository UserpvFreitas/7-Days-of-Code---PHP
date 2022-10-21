<?php
const arquivo = ".\data\users.json";

function crud_create($user){
    $data = file_get_contents(arquivo);
    $data = json_decode($data);
    $data[] = $user;
    $data = json_encode($data);
    file_put_contents(arquivo, $data);
}

function crud_restore($email){
    $data = file_get_contents(arquivo);
    $data = json_decode($data, true);
    
    foreach($data as $d){
        if($d['email'] == $email){
            return $d;
        }
    }

    return null;
}

function crud_update($email){
    $user = crud_restore($email);
    $user['mail_validation'] = true;

    $data = file_get_contents(arquivo);
    $data = json_decode($data, true);
    
    foreach($data as $d){
        if($d['email'] == $user['email']){
            $t = array_search($d, $data);
            unset($data[$t]);
            $data[] = $user;
        }
    }
    
    $data = json_encode($data);    
    file_put_contents(arquivo, $data);
}

function crud_delete($email){
    $user = crud_restore($email);

    $data = file_get_contents(arquivo);
    $data = json_decode($data, true);
    
    foreach($data as $d){
        if($d['email'] == $user['email']){
            $t = array_search($d, $data);
            unset($data[$t]);
        }
    }

    $data = json_encode($data);    
    file_put_contents(arquivo, $data);
    
    auth_logout();
}

function check_email($email){
    return verifica_email($email, arquivo);
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