<?php defined('BASEPATH') or exit('No direct script access allowed');

function string_random($length = 5){
    $result = '';
    $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    for($i=0; $i<$length; $i++){
        $result .= $char[rand(0 , strlen($char)-1)];
    }
    return $result;
}