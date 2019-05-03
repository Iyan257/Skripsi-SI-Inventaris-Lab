<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->in_group('kalab') && !$this->ion_auth->in_group('input_admin')) {
            show_404();
        }
		$this->load->library(['session']);
		$this->load->model(['kategori_model']);
	}
	public function index()
	{
		$data = [
            'subtitle' => 'Kategori',
            'pages' => ['Kategori' => 'kategori'],
			'user' => $this->user,
			'categories' => $this->kategori_model->get_categories(),
        ];
        $this->layout->template('admin')->render('kategori/index', $data);
	}

	public function store()
    {    
		$this->form_validation->set_rules('kategori', 'kategori', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('kategori');
		}
		
		$data = array( 
			'nama_kategori' => $this->input->post('kategori'),
		);

		
		$this->kategori_model->create_category($data);

		$this->session->set_flashdata('message', 'Successfully add category for asset.');
		redirect('kategori');
	}
	
	public function edit($id)
    {
        $category = $this->kategori_model->get_categories($id);
        $this->layout->template('admin')->render('kategori/edit', [
            'category' => $category,
			'user' => $this->user,
            'subtitle' => "kategori",
            'pages' => ['Kategori' => 'kategori', 'Edit' => 'kategori/edit/'.$id],
            'header' => "Edit kategori '" . $category['nama_kategori'] . "'",
        ]);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('kategori', 'kategori', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('kategori');
		}
		
		$data = array( 
            'id' => $id,
            'nama_kategori' => $this->input->post('kategori'),
        );
        
        $category = $this->kategori_model->update_category($data);

        $this->session->set_flashdata('message', "Successfully update category '" . $category['nama_kategori'] . "'.");
        redirect('kategori');

    }

    public function delete($id)
    {
        $this->kategori_model->delete_category($id);
        $this->session->set_flashdata('message', 'Successfully delete category.');
        redirect('kategori');
    }
}
