<?php

function render_view($template, $msg = null){
    $content = file_get_contents(VIEW_FOLDER.$template);    

    foreach($msg as $key => $value){
        if(is_numeric(mb_strpos($key, 'erro')))
            $content = str_replace("{{".$key."}}", '<span class="mensagem-erro">'.$value.'</span>', $content);
        if(is_numeric(mb_strpos($key, 'sucesso')))
            $content = str_replace("{{".$key."}}", '<div class="mensagem-sucesso">'.$value.'</div>', $content);
        if(is_numeric(mb_strpos($key, 'field')))
            $content = str_replace("{{".$key."}}", $value, $content);
    }

    $content = preg_replace('/{{.*.}}/', '', $content);

    echo $content;
}
