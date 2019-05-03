<?php defined('BASEPATH') or exit('No direct script access allowed');

function mdatenow($timezone = 'Asia/Bangkok')
{
    return mdate('%Y-%m-%d %H:%i:%s', now($timezone));
}