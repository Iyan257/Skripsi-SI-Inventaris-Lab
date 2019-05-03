<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;

class Aset extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->is_admin()) {
            show_404();
        }
		$this->load->library(['session','barcoder']);
		$this->load->model(['kategori_model', 'kategori_khusus_model','ruangan_model','aset_model','riwayat_perbaikan_model', 'spesifikasi_model']);
	}
	public function index()
	{
		$condition = [];
		if($_SERVER['REQUEST_METHOD']=='GET'){
			if($this->input->get('kode') != null){
				$condition['kode'] = $this->input->get('kode');
			}
			if($this->input->get('kategori') != null){
				$condition['aset.id_kategori'] = $this->input->get('kategori');
			}
			if($this->input->get('ruangan') != null){
				$condition['id_ruangan'] = $this->input->get('ruangan');
			}
			if($this->input->get('thn_pembelian') != null){
				$condition['year(tanggal_penerimaan)'] = $this->input->get('thn_pembelian');
			}
			if($this->input->get('kondisi') != null){
				$condition['kondisi'] = $this->input->get('kondisi');
			}
			if($this->input->get('type') != null){
				$condition['type'] = $this->input->get('type');
			}
			if($this->input->get('processor') != null){
				$condition['processor'] = $this->input->get('processor');
			}
			if($this->input->get('os') != null){
				$condition['os'] = $this->input->get('os');
			}
			if($this->input->get('memory') != null){
				$condition['memory'] = $this->input->get('memory');
			}
			if($this->input->get('hard_drive') != null){
				$condition['hard_drive'] = $this->input->get('hard_drive');
			}
			if($this->input->get('jumlah_port') != null){
				$condition['jumlah_port'] = $this->input->get('jumlah_port');
			}
		}

        $data = [
			'subtitle' => 'Aset Inventaris',
			'pages' => ['Aset' => 'aset'],

			'user' => $this->user,
			'groups' =>$this->groups,
			'assets' => $this->aset_model->get_assets(false, $condition),
			'kategori' => $this->kategori_model->get_categories(),
			'ruangan' => $this->ruangan_model->get_rooms(),
			'spesifikasi' => $this->spesifikasi_model->get_all_specification(),
		];
        $this->layout->template('admin')->render('aset/index', $data);
	}
	
	public function view($id)
	{
		$asset = $this->aset_model->get_assets($id);
        $this->layout->template('admin')->render('aset/detail', [
			'asset' => $asset,
			'history' => $this->riwayat_perbaikan_model->get_history(false,['kode' => $asset['kode']]),
			'specification' => $this->spesifikasi_model->get_specification($asset['id_spesifikasi']),
			'user' => $this->user,
			'groups' =>$this->groups,
			'info_barcode' => $this->barcoder->getInfo($asset['nama']),
			
			'subtitle' => "Aset",
			'pages' => ['Aset' => 'aset', 'View'=>'aset/'.$id],
            'header' => "Aset '" . $asset['nama_aset'] . "'",
        ]);
	}
	
	public function download()
	{
		header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename=data_assets.csv');  
		$output = fopen("php://output", "w"); 
		
		$array_field = array('#', 'tanggal_penerimaan', 'kode', 'nama_kategori', 'nama_kategori_khusus', 'nama_aset', 'merek','kondisi',
		'nama', 'ruangan');
		fputcsv($output, $array_field);  
		
		$result = $this->aset_model->get_assets(false,[],true);
		
        foreach($result as $i => $row)  
		{  
			$res = [$i+1];
			$row_fields = array_keys($row);
			foreach($array_field as $field){
				if(in_array($field, $row_fields)){
					$res[$field] = $row[$field];
				}
			}
            fputcsv($output, $res); 
		}
        fclose($output); 
	}

	public function download_image($id)
	{
		$this->load->helper('download');
		$file_name = $this->aset_model->get_assets($id)['gambar'];
		if($file_name == null){
			$this->session->set_flashdata('errors', "No image found.");
        	redirect('aset/index');
		}
		$public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
		$download_path = $public_path.'/assets/images/aset/'.$file_name;
		force_download($download_path, NULL);
	}
}

