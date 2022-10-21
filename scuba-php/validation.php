<?php

function valida_registro($pessoa):string{
    if(strlen($pessoa['password']) < 10)
        return "A senha deve ter ao menos 10 dígitos.";
    else if($pessoa['password-confirm'] != $pessoa['password'])
        return "Senha e confirmação devem ser iguais.";
    else return "";
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
