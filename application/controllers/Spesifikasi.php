<?php defined('BASEPATH') or exit('No direct script access allowed');

class Spesifikasi extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('spesifikasi_model');
    }

    public function index()
    {
        $data = [
            'user' => $this->user,
            'pages' => ['Spesifikasi' => 'spesifikasi'],

            'subtitle' => 'Spesifikasi Elektronik',
            'header' => 'Profile Configurations',
            'specification' => $this->spesifikasi_model->get_specification(),
        ];

        $this->layout->template('admin')->render('spesifikasi/index', $data);
    }

    public function create()
    {
        $data = [
            'user' => $this->user,
            'pages' => ['Spesifikasi' => 'spesifikasi', 'Create' => 'spesifikasi/create'],

            'subtitle' => 'Spesifikasi Elektronik',
        ];

        $this->layout->template('admin')->render('spesifikasi/create', $data);
    }
    public function store()
    {
        $data = array( 
			'type' => $this->input->post('type'),
			'jumlah_port' => $this->input->post('port'),
			'processor' => $this->input->post('processor'),
            'os1' => $this->input->post('os1'),
            'os2' => $this->input->post('os2'),
            'os3' => $this->input->post('os3'),
			'memory' => $this->input->post('memory'),
            'hard_drive' => $this->input->post('hard_drive'),
            'keterangan' => $this->input->post('keterangan'),
		);

        $check = $this->spesifikasi_model->get_specification(false, $data);
        if(empty($check)){
            $this->spesifikasi_model->create_specification($data);
            $this->session->set_flashdata('message', 'Successfully add specification.');
            redirect('spesifikasi/index');
        }else{
            $this->session->set_flashdata('errors', 'Specification already exist, the id is '.$check[0]['id']);
            redirect('spesifikasi/index');
        }
    }
    public function edit($id)
    {
        $specification = $this->spesifikasi_model->get_specification($id);
        $this->layout->template('admin')->render('spesifikasi/edit', [
            'specification' => $specification,
            'errors' => $this->session->flashdata('errors'),
            
			'user' => $this->user,
            'pages' => ['Spesifikasi' => 'spesifikasi', 'Edit' => 'spesifikasi/edit/'.$id],
            'subtitle' => 'Spesifikasi Elektronik',
		]);
    }
    public function update($id)
    {
        $data = array( 
            'id' => $id,
			'type' => $this->input->post('type'),
			'jumlah_port' => $this->input->post('port'),
			'processor' => $this->input->post('processor'),
            'os1' => $this->input->post('os1'),
            'os2' => $this->input->post('os2'),
            'os3' => $this->input->post('os3'),
			'memory' => $this->input->post('memory'),
            'hard_drive' => $this->input->post('hard_drive'),
            'keterangan' => $this->input->post('keterangan'),
		);

        $this->spesifikasi_model->update_specification($data);
        $this->session->set_flashdata('message', 'Successfully update specification.');
        redirect('spesifikasi/index');
    }

    public function delete($id)
    {
        $this->spesifikasi_model->delete_specification($id);
        $this->session->set_flashdata('message', 'Successfully delete specification.');
        redirect('spesifikasi/index');
	}
}
