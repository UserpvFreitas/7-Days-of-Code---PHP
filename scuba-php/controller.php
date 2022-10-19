<?php

function do_register(){
    if($_POST['person']  ?? false){
        $msg = ['erro' => valida_registro($_POST['person']), 'sucesso' => ""];
        
        if($msg['erro'] != ""){
            render_view("register.view", $msg);    
        }else{
            $_POST["person"]["mail_validation"] = false;
            
            unset($_POST['person']['password-confirm']);
            
            $result = save($_POST['person']);

            if($result['sucesso']){
                send_confirmation_mail($_POST['person']['email']);

                $msg['sucesso'] = "
                    <p>
                        Usuário criado com sucesso.<br/>
                        Confirme seu e-mail para ativá-lo.
                    </p>                
                ";            
                render_view("login.view", $msg);
            }else{
                $msg['erro'] = $result['msg'];
                render_view("register.view", $msg);
            }
        }
    }else{
        render_view("register.view");
    }
}

function do_login(){  
    if($_POST['confirmation'] == ""){
        render_view("login.view");
    }else{
        $msg = ['erro' => "", 'sucesso' => ""];

        $validacao = confirm_user($_POST['confirmation']);

        if(!$validacao){
            $msg['erro'] = "E-mail não validado.</br>Usuário não cadastrado no sistema.";
        }else{
            $msg['sucesso'] = "<p>E-mail validado com sucesso.<br/>Seja bem vindo(a), ".$validacao."!</p>";            
        }
        render_view("login.view", $msg);
    }
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

function save($user):array{
    $return = ['sucesso' => false, 'msg' => ''];

    if(!check_email($user['email'])){
        $return['sucesso'] = crud_create($user);
    }else{
        $return['msg'] = "E-mail já atribuído a um usuário!";
    }

    return $return;

}

function confirm_user($user){
    return check_email($user);
}

function do_validation($token){
    echo $token;
    //render_view("login.view");
}