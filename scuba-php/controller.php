<?php

function do_register(){
    if($_POST['person']  ?? false){
        $msg = ['erro' => valida_registro($_POST['person']), 'sucesso' => ""];
        
        if($msg['erro'] != ""){
            render_view("register.view", $msg);    
        }else{
            unset($_POST['person']['password-confirm']);
            save($_POST['person']);

            $msg['sucesso'] = "
                <form action=\"/?page=login&from=login\" method=\"POST\">        
                    <p>
                        Usuário criado com sucesso.<br/>
                        Confirme seu e-mail para ativá-lo.
                    </p>
                    </br></br>
                    <input type=\"text\" name=\"confirmation\" required>
                    <span class=\"mensagem-erro\"></span>
                    <button>Confirmar</button>
                </form>
            ";
            
            render_view("login.view", $msg);
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

        var_dump($_POST);
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

function save($user){
    crud_create($user);
}

function confirm_user($user){
    return check_email($user);
}