<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->in_group('kalab') && !$this->ion_auth->in_group('input_admin')) {
            show_404();
        }
		$this->load->library(['session']);
		$this->load->model(['ruangan_model']);
	}
	public function index()
	{
		$data = [
			'subtitle' => 'Ruangan',
			'pages' => ['Ruangan'=>'ruangan'],
			'user' => $this->user,
			'rooms' => $this->ruangan_model->get_rooms(),
        ];
        $this->layout->template('admin')->render('ruangan/index', $data);
	}
	public function create()
    {
        $this->layout->template('admin')->render('ruangan/create', [
            'errors' => $this->session->flashdata('errors'),

            'user' => $this->user,
            'subtitle' => 'Gallery',
        ]);
	}

	public function store()
    {    
		$this->form_validation->set_rules('name', 'nama', 'required');
		$this->form_validation->set_rules('room', 'ruangan', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('ruangan');
		}
		
		$data = array( 
			'nama' => $this->input->post('name'),
			'ruangan' => $this->input->post('room'),
		);

		if(!empty($_FILES['userfile']['name'])){
			$this->load->helper(['string','config_file']);
			$file_name = string_random(5).'_'.$_FILES['userfile']['name'];
			$file_name = str_replace(' ', '_', $file_name);
			$folder_name = 'ruangan';

			// Upload Image
			$this->load->library('upload', get_image_configuration($folder_name, $file_name));
	
			if(!$this->upload->do_upload()){
				$this->session->set_flashdata('errors', $this->upload->display_errors());
				redirect('ruangan');
			} else {
				//$data = array('upload_data' => $this->upload->data());
				$data['gambar'] = $file_name;
			}
		}
		
		$this->ruangan_model->create_room($data);

		$this->session->set_flashdata('message', 'Successfully add room.');
		redirect('ruangan');
	}
	
	public function edit($id)
    {
        $room = $this->ruangan_model->get_rooms($id);
        $this->layout->template('admin')->render('ruangan/edit', [
            'room' => $room,
			'user' => $this->user,
			'subtitle' => "Ruangan",
			'pages' => ['Ruangan' => 'ruangan', 'Edit' => 'ruangan/edit/'.$id],
            'header' => "Edit Ruangan '" . $room['ruangan'] . "'",
        ]);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'nama', 'required');
		$this->form_validation->set_rules('room', 'ruangan', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('ruangan');
		}
		
		$data = array( 
			'id' => $id,
			'nama' => $this->input->post('name'),
			'ruangan' => $this->input->post('room'),
		);

		if(!empty($_FILES['userfile']['name'])){
			$this->load->helper(['string','config_file']);
			$file_name = string_random(5).'_'.$_FILES['userfile']['name'];
			$file_name = str_replace(' ', '_', $file_name);
			$folder_name = 'ruangan';

			// Upload Image
			$this->load->library('upload', get_image_configuration($folder_name, $file_name));

			if(!$this->upload->do_upload()){
				$this->session->set_flashdata('errors', $this->upload->display_errors());
				redirect('ruangan');
			} else {
				//$data = array('upload_data' => $this->upload->data());
				$data['gambar'] = $file_name;
			}
		}
        $room = $this->ruangan_model->update_room($data);

        $this->session->set_flashdata('message', "Successfully update room '" . $room['nama'] . "'.");
        redirect('ruangan');

    }

    public function delete($id)
    {
        $this->ruangan_model->delete_room($id);
        $this->session->set_flashdata('message', 'Successfully delete room.');
        redirect('ruangan');
    }
}
