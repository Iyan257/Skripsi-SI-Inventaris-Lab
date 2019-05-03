<?php defined('BASEPATH') or exit('No direct script access allowed');

function get_image_configuration($folder_name='' , $file_name='userfile'){
    $public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
    $upload_path = $public_path.'/assets/images/'.$folder_name.'/';
    if(!file_exists($upload_path)) {
        mkdir($upload_path);
        copy($public_path.'index.html', $upload_path.'index.html');
        file_put_contents($upload_path.'.gitignore', "*\r\n!.gitignore\r\n!index.html");
    }

    $config['upload_path'] = $upload_path;
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '2048';
    $config['max_width'] = '2000';
    $config['max_height'] = '2000';
    $config['file_name'] = $file_name;
    return $config;
}

function get_file_configuration($folder_name='' , $file_name='userfile'){
    $public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
    $upload_path = $public_path.'/assets/'.$folder_name.'/';
    if(!file_exists($upload_path)) {
        mkdir($upload_path);
        copy($public_path.'index.html', $upload_path.'index.html');
        file_put_contents($upload_path.'.gitignore', "*\r\n!.gitignore\r\n!index.html");
    }

    $config['upload_path'] = $upload_path;
    $config['allowed_types'] = 'pdf';
    $config['max_size'] = '2048';
    $config['max_width'] = '2000';
    $config['max_height'] = '2000';
    $config['file_name'] = $file_name;
    return $config;
}

/**
 * Delete file
 */
function delete_file($folder_name, $file_name, $pdf=false) {
    if($pdf){
        $public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
        $file = $public_path.'/assets/'.$folder_name.'/'.$file_name;
        return unlink($file);
    }
    $public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
    $file = $public_path.'/assets/images/'.$folder_name.'/'.$file_name;
    return unlink($file);
}

function get_public_path (){
    $public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
    return $public_path;
}