<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->in_group('kalab')) {
            show_404();
        }

        $this->load->library('session');
    }

    public function index()
    {
        $users = $this->ion_auth->users()->result();
        foreach ($users as $k => $user) {
            $user->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }

        $data = [
            'users' => $users,

            'user' => $this->user,
            'subtitle' => 'Users',
            'message' => $this->session->flashdata('errors'),
        ];
        $this->layout->template('admin')->render('users/index', $data);
    }

    public function create()
    {
        $this->layout->template('admin')->render('users/create', [
            'groups' => $this->ion_auth->groups()->result(),

            'user' => $this->user,
            'subtitle' => 'Users',
            'header' => 'Create User',
        ]);
    }

    public function store()
    {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('code', 'code', 'required');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('group', 'group', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('kalab/users/create');
        }

        $this->load->helper('string');
        $password = random_string('alnum', $this->config->item('min_password_length', 'ion_auth'));
        $username = $this->input->post('username');
        $groups = [$this->input->post('group')];
        $additional_data = [
            'name' => $this->input->post('name'),
            'inisial' => $this->input->post('code'),
        ];

        $user_id = $this->ion_auth->register($username, $password, false, $additional_data, $groups);
        if (!$user_id) {
            $this->session->set_flashdata('errors', $this->ion_auth->errors());
            redirect('kalab/users/create');
        }

        $this->session->set_flashdata('message', "Successfully add user <b>\"$username\"</b> with password <b>\"$password\"</b>.");
        redirect('kalab/users');
    }

    public function edit($id)
    {
        if ($id == 1 || $id == $this->user->id) {
            $this->session->set_flashdata('errors', 'You can\'t edit superuser or yourself.');
            redirect('admin/users');
        }

        $edit_user = $this->ion_auth->user($id)->row();
        $edit_user->groups = $this->ion_auth->get_users_groups($id)->result();
        $this->layout->template('admin')->render('users/edit', [
            'edit_user' => $edit_user,
            'groups' => $this->ion_auth->groups()->result(),

            'user' => $this->user,
            'header' => "Edit user '" . $edit_user->name . "'",
            'errors' => $this->session->flashdata('errors'),
        ]);
    }

    public function update($id)
    {
        if ($id == 1 || $id == $this->user->id) {
            $this->session->set_flashdata('errors', 'You can\'t update superuser or yourself.');
            redirect('kalab/users');
        }

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('code', 'code', 'required');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('group', 'group', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect("kalab/users/edit/$id");
        }
        
        $data = [
            'name' => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'inisial' => $this->input->post('code'),
        ];
        
        if($this->input->post('random_password')) {
            $this->load->helper('string');
            $data['password'] = random_string('alnum', $this->config->item('min_password_length', 'ion_auth'));
        }
        
        $this->ion_auth->remove_from_group('', $id);
        $this->ion_auth->add_to_group($this->input->post('group'), $id);
        
        if (!$this->ion_auth->update($id, $data)) {
            $this->session->set_flashdata('errors', $this->ion_auth->errors());
            redirect("kalab/users/edit/$id");
        }

        $this->session->set_flashdata('message', 'Successfully update user <b>"' . $data['name'] . '"</b>' . (isset($data['password'])? ' with new password <b>"' . $data['password'] . '"</b>' : '.'));
        redirect('kalab/users');
    }

    public function delete($id)
    {
        if ($id == 1 || $id == $this->user->id) {
            $this->session->set_flashdata('errors', 'You can\'t delete superuser or yourself.');
            redirect('kalab/users');
        }

        $this->ion_auth->deactivate($id);
        $this->session->set_flashdata('message', 'Successfully delete user.');
        redirect('kalab/users');
    }
}
