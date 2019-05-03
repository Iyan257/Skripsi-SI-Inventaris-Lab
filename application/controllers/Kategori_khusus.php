<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_khusus extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->in_group('kalab') && !$this->ion_auth->in_group('input_admin')) {
            show_404();
        }
		$this->load->library(['session']);
		$this->load->model(['kategori_khusus_model','kategori_model']);
	}
	public function index()
	{
		$data = [
            'subtitle' => 'Kategori Khusus',
            'pages' => ['Kategori Khusus' => 'kategori_khusus'],
            'user' => $this->user,
            'kategori' => $this->kategori_model->get_categories(),
			'categories' => $this->kategori_khusus_model->get_categories(),
        ];
        $this->layout->template('admin')->render('kategori_khusus/index', $data);
	}

	public function store()
    {   
        $this->form_validation->set_rules('id_kategori', 'Id kategori', 'required'); 
        $this->form_validation->set_rules('kategori', 'kategori', 'required');
        $this->form_validation->set_rules('warna_label', 'warna label', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('kategori_khusus/index');
		}
        
        //check code exist
		$check = $this->kategori_khusus_model->get_categories(false, ['nama_kategori_khusus' => $this->input->post('kategori') ]);
		if($check != null){
			$this->session->set_flashdata('errors', 'Sorry, the name of the special category already exists.');
            redirect('kategori_khusus/index');
		}
		$data = array( 
            'id_kategori' => $this->input->post('id_kategori'),
            'nama_kategori_khusus' => $this->input->post('kategori'),
		);
        if($this->input->post('warna_label') != '#ffffff'){
            $data['warna_label'] = $this->input->post('warna_label');
        } 
		
		$this->kategori_khusus_model->create_category($data);

		$this->session->set_flashdata('message', 'Successfully add specific category for asset.');
		redirect('kategori_khusus/index');
	}
	
	public function edit($id)
    {
        $category = $this->kategori_khusus_model->get_categories($id);
        $this->layout->template('admin')->render('kategori_khusus/edit', [
            'category' => $category,
            'kategori' => $this->kategori_model->get_categories(),

			'user' => $this->user,
            'subtitle' => "kategori khusus",
            'pages' => ['Kategori Khusus' => 'kategori_khusus', 'Edit' => 'kategori_khusus/edit/'.$id],
            'header' => "Edit kategori khusus '" . $category['nama_kategori_khusus'] . "'",
        ]);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('id_kategori', 'Id kategori', 'required'); 
        $this->form_validation->set_rules('kategori', 'kategori', 'required');
        $this->form_validation->set_rules('warna_label', 'warna label', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('kategori_khusus/index');
		}
		
		$data = array( 
            'id' => $id,
            'id_kategori' => $this->input->post('id_kategori'),
            'nama_kategori_khusus' => $this->input->post('kategori'),
        );
        if($this->input->post('warna_label') != '#ffffff'){
            $data['warna_label'] = $this->input->post('warna_label');
        } 
        
        $category = $this->kategori_khusus_model->update_category($data);

        $this->session->set_flashdata('message', "Successfully update specific category '" . $category['nama_kategori_khusus'] . "'.");
        redirect('kategori_khusus/index');

    }

    public function delete($id)
    {
        $this->kategori_khusus_model->delete_category($id);
        $this->session->set_flashdata('message', 'Successfully delete specific category.');
        redirect('kategori_khusus/index');
    }
}
