<?php
const ENCRYPTED_METHOD = 'AES-128-CBC';

function ssl_decrypt($data){
    return openssl_decrypt($data, ENCRYPTED_METHOD, SECRET, 0, SECRET_IV);
}

function ssl_crypt($data){
    return openssl_encrypt($data, ENCRYPTED_METHOD, SECRET, 0, SECRET_IV);     
}