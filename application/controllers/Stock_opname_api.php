<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_opname_api extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}
	public function index()
	{
	}

	public function set_exist(){
		header("Access-Control-Allow-Origin: *");     
		header("Access-Control-Allow-Methods: GET, OPTIONS");     
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");     
	
		$kode_aset= $this->input->get('kode');
		
		$condition = [
			'kode' => $kode_aset,
		];
	 
		$this->load->model(['aset_model', 'stock_opname_model']);
		$aset = $this->aset_model->get_assets(false, $condition)[0];

		if($this->stock_opname_model->get_status() == 0){
			// layanan stock opname tidak tersedia
			$status_code = 503;
			$json_result = [
				'status' => 'error',
				'message' => 'Layanan untuk stock opname tidak tersedia saat ini',
				'kod' => $kode_aset, 
				'thn' => substr($aset['tanggal_penerimaan'],0,4),
				'mrk' => $aset['merek'],
			];
		}else{
			if(isset($aset)){
				$this->stock_opname_model->insert_aset(['kode'=>$kode_aset]);
				$status_code = 200;
				$json_result = [
					'status' => 'OK',
					'result' => 'Aset sudah ditambahkan pada laporan stock opname',
					'kode' => $kode_aset, 
				];
			}else{
				$status_code = 400;
				$json_result = [
					'status' => 'error',
					'message' => 'Tidak ditemukan aset dengan kode yang dimaksud',
					'kode' => $kode_aset, 
				];
			}
		}

			
		return $this->output       
		->set_content_type('application/json')       
		->set_status_header($status_code)       
        ->set_output(json_encode($json_result));
	}
}

