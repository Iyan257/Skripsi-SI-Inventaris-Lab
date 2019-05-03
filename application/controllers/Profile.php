<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'min_password_length' => $this->config->item('min_password_length', 'ion_auth'),
            'user' => $this->user,

            'subtitle' => 'Profile',
            'header' => 'Profile Configurations',
        ];

        $this->layout->template('admin')->render('profile/index', $data);
    }

    public function update()
    {
        if ($this->input->post('name')) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('inisial', 'Inisial', 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect('profile');
            }

            $status = $this->ion_auth->update($this->user->id, [
                'name' => $this->input->post('name'),
                'inisial' => $this->input->post('inisial'),
            ]);

        } else {
            $this->form_validation->set_rules('old', 'old password', 'required');
            $this->form_validation->set_rules('new', 'new password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', 'confirm new password', 'required');
            
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect('profile');
            }

            $identity = $this->session->userdata('identity');

            $status = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));
        }

        if ($status) {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
        } else {
            $this->session->set_flashdata('errors', $this->ion_auth->errors());
        }

        redirect('profile');
    }
}
