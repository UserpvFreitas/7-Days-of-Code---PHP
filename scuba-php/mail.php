<?php

use PHPMailer\PHPMailer\PHPMailer;

function send_confirmation_mail($email){
    $token = ssl_crypt($email);
    send_mail(
        "Validação de e-mail", 
        "Para validar o seu e-mail, clique <a href=\"http://localhost:4242?page=mail-validation&token=".$token."\">aqui</a>", 
        $email
    );
}


function send_password_redefinition($email){
    $dataHoje = (new DateTime())->format('Y-m-d');
    
    $token = urlencode(ssl_crypt(base64_encode("$email:$dataHoje")));
    send_mail(
        "Redefinição de senha", 
        "Para redefinir sua senha, clique <a href=\"http://localhost:4242?page=change-password&token=".$token."\">aqui</a>", 
        $email
    );
}

function send_mail($subject, $message, $address){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = EMAIL;
    $mail->Password = PWD;
    $mail->Port = 587;
    $mail->CharSet = "UTF-8";


    $mail->setFrom('pvAlura@gmail.com');
    $mail->addAddress($address);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();
    
    /*if(!$mail->send()) {
        echo 'Não foi possível enviar a mensagem.<br>';
        echo 'Erro: ' . $mail->ErrorInfo;
    } else {
        echo 'Mensagem enviada.';
    }*/
    
}