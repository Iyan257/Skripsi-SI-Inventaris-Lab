<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
}

class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation', 'layout']);
        $this->form_validation->set_error_delimiters('', '');

        if ($this->ion_auth->logged_in() === false) {
            show_404();
        }

        $this->user = $this->ion_auth->user()->row();
        $groups = $this->ion_auth->get_users_groups($this->user->id)->result();

        $this->groups = array_map(function ($x) use ($groups){
            return $groups[$x]->name;
        }, range(0, count($groups) - 1));
    }
}
