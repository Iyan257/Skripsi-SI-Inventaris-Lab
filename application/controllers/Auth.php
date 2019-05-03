<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation', 'layout']);

        $this->user = $this->ion_auth->user()->row();
    }

    public function index()
    {
        if ($this->ion_auth->logged_in() === false) {
            redirect('auth/login');
        }
        
        if ($this->ion_auth->in_group('kalab')){
            redirect('kalab/home');
        }
        redirect('/home');
    }
    
    public function login()
    {
        if ($this->ion_auth->logged_in()) {
            redirect('auth');
        }
        
        $this->config->load('ion_auth', true);

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() === true) {
            $remember = $this->config->item('remember_users', 'ion_auth') === false ? false : (bool) $this->input->post('remember');

            $login_status = $this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember);
            if ($login_status === false) {
                $this->session->set_flashdata('errors', $this->ion_auth->errors());
                redirect('auth/login');
            }

            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('/');
        } else {
            $data = [
                'username' => set_value('username'),
                'message' => $this->session->flashdata('message'),
                'errors' => validation_errors() ? validation_errors() : $this->session->flashdata('errors'),
                'is_rememberme_enabled' => $this->config->item('remember_users', 'ion_auth'),
            ];

            $this->load->view('auth/login', $data);
        }
    }

    public function logout()
    {
        $logout = $this->ion_auth->logout();
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('auth/login');
    }
}
