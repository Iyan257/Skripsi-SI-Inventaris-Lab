<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Template Location
| -------------------------------------------------------------------
| This config is used to define the location used to store templates,
| with or without following/trailing slashes, from views path. If
| you don't set the views path, the default views path is:
|     APPPATH/views
| So, if your template location is on APPPATH/templates and the views
| path is default, then the template location is on:
|     ../templates
|
*/

$config['template_location'] = '../templates';

/*
| -------------------------------------------------------------------
| Default Template
| -------------------------------------------------------------------
| This config is used to define the default template that will be
| used to render view. The path root is already in template location,
| and without trailing .php. Set to NULL if you don't want to use any
| default template.
|
*/

$config['default_template'] = 'admin';

/*
| -------------------------------------------------------------------
| Default Values
| -------------------------------------------------------------------
| This config is used to define default values binded when rendering
| the view. Binded values will override default values that has the
| same key.
|
*/

$config['default_values'] = [

];
