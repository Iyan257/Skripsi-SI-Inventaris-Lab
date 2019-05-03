<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_api extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}
	public function index()
	{
	}

	public function search_computer(){
		header("Access-Control-Allow-Origin: *");     
		header("Access-Control-Allow-Methods: GET, OPTIONS");     
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");     
	
		$kondisi = $this->input->get('kondisi');
		$ruangan = $this->input->get('ruangan');
		$condition = [
			'computer_in_rooms' => 'ya',
			'kondisi' => $kondisi,
			'ruangan' => $ruangan,
		];
	 
		$this->load->model('aset_model');

		return $this->output       
		->set_content_type('application/json')       
		->set_status_header(200)       
		->set_output(json_encode($this->aset_model->get_assets(false, $condition)));
	}
}

