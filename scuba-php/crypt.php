<?php

function ssl_decrypt($data){
    return openssl_decrypt($data['msg'], "aes-256-cbc-hmac-sha1", $data);
}

function ssl_crypt($data){
    return openssl_encrypt($data['msg'], "aes-256-cbc-hmac-sha1", $data);
}