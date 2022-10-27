<?php

function do_register(){
    if($_POST['person']  ?? false){
        $msg = valida_registro($_POST['person']);
        
        if(count($msg) > 0){
            render_view("register.view", $msg);    
        }else{
            $_POST["person"]["mail_validation"] = false;
            $_POST["person"]["password"] = md5($_POST["person"]["password"]);
            
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
                $msg['erro_email'] = $result['erro_email'];
                render_view("register.view", $msg);
            }
        }
    }else{
        render_view("register.view");
    }
}

function do_login(){ 
    if($_POST['confirmation'] == ""){
        if($_POST['person']['email'] != "" && $_POST['person']['password'] != ""){
            if(authentication($_POST['person']['email'], $_POST['person']['password'])){
                header("Location: /");
                die();
            }else{
                $msg = ['erro_password' => 'Usuário ou/e senha incorretos'];
                render_view("login.view", $msg);    
            }
        }else{
            render_view("login.view", null);
        }
    }else{
        $msg = ['erro' => "", 'sucesso' => ""];

        $validacao = confirm_user($_POST['confirmation']);

        if(!$validacao){
            $msg = ['erro_password' => "E-mail não validado.</br>Usuário não cadastrado no sistema."];
        }else{
            $msg = ['sucesso' => "<p>E-mail validado com sucesso.<br/>Seja bem vindo(a), ".$validacao."!</p>"];
        }

        render_view("login.view", $msg);
    }
}

function do_logout(){
    auth_logout();    
}

function do_delete_account(){
    crud_delete($_SESSION['email']);
}

function do_not_found(){
    render_view("not_found.view");
}

function do_forget_password(){
    $request_method = $_SERVER['REQUEST_METHOD'];

    if($request_method == 'POST'){
        $user = crud_restore($_POST['person']['email']);
        if($user != null){
            send_password_redefinition($_POST['person']['email']);
            
            $msg = ['sucesso' => '<p>Seu link para redefinição de senha foi enviado para o e-mail</p>'];                      
            render_view("login.view", $msg);  
        }else{
            $msg = ['erro_email'=> 'Não existe usuário para o e-mail informado'];                      
            render_view("forget_password.view", $msg);
        }
    }else{
        render_view("forget_password.view");
    }
}

function do_change_password($token){    
    $request_method = $_SERVER['REQUEST_METHOD'];    
        
    if($request_method == 'POST'){
        $params = explode(':', base64_decode(ssl_decrypt($_POST['person']['token'])));
        
        $user = crud_restore($params[0]);

        if($user != null && $user['email'] == $params[0]){
            $user['password'] = $_POST['person']['password'];
            $user['password-confirm'] = $_POST['person']['password-confirm'];

            $msg = validate_change_password($user);

            if(count($msg) > 0){
                render_view("change_password.view", $msg);    
            }else{
                $user['password'] = md5($user['password']);
                unset($user['password-confirm']);

                crud_update($user);

                $msg['sucesso'] = '<p>Senha alterada com sucesso</p>';
                render_view("login.view", $msg);
            }
        } 
    }else{
        $msg['field_token'] = $token;    

        $dataExpiracao = (new DateTime())->modify("+ 1day");
        $params = explode(':', base64_decode(ssl_decrypt($token)));

        $dataHoje = DateTime::createFromFormat('Y-m-d',$params[1]);

        if($dataHoje < $dataExpiracao){
            //$msg = ['success' => 'Usuário redefinido!', 'erro' => ''];
            render_view("change_password.view", $msg);
        }else{
            $msg['erro_email'] = 'Token expirado';
            render_view('login.view', $msg);
        }   
    }
    
}

function do_home(){
    $user = auth_user();
    $msg = $user;
    render_view('home.view', $msg);
}

function save($user):array{
    $return = ['sucesso' => '', 'erro_email' => ''];
    
    if(!check_email($user['email'])){
        crud_create($user);
        $return['sucesso'] = true;
    }else{
        $return['erro_email'] = "E-mail já atribuído a um usuário!";
    }

    return $return;

}

function confirm_user($user){
    return check_email($user);
}

function do_validation($token){
    crud_confirm_email(ssl_decrypt($token));
    render_view("login.view");
}