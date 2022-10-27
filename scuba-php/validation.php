<?php

function valida_registro($pessoa):array{
    $msg = [];

    if(strlen($pessoa['password']) < 10){
        $msg['erro_password'] = "A senha deve ter ao menos 10 dígitos.";
        return $msg;
    }else if($pessoa['password-confirm'] != $pessoa['password']){
        $msg['erro_confirmacao'] = "Senha e confirmação devem ser iguais.";
        return $msg;
    }else{
        return $msg;
    } 
}

function verifica_email($email, $arquivo){
    $data = file_get_contents($arquivo);
    $data = json_decode($data, true);

    foreach($data as $d){
        if($d['email'] == $email){
            return $d['name'];
        } 
    }

    return false;
}

function validate_change_password($user){
    return valida_registro($user);
}