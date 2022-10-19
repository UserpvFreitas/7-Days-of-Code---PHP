<?php

function render_view($template, $msg = null){
    $content = file_get_contents(VIEW_FOLDER.$template);

    if($msg['erro'] != "")
        $content = str_replace("<span class=\"mensagem-erro\"></span>", "<span class=\"mensagem-erro\">".$msg['erro']."</span>", $content);
    else if($msg['sucesso'] != ""){
        $content = str_replace("<div class=\"mensagem-sucesso\"></div>", "<div class=\"mensagem-sucesso\">".$msg['sucesso']."</div>", $content);
    }

    echo $content;
}