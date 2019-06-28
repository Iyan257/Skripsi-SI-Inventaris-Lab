<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Aset extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->in_group('kalab') && !$this->ion_auth->in_group('input_admin')) {
            show_404();
        }
		$this->load->library(['session', 'barcoder']);
		$this->load->model(['kategori_model', 'kategori_khusus_model','ruangan_model','aset_model',
		'riwayat_perbaikan_model', 'spesifikasi_model', 'acuan_aset_model']);
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
			if($this->input->get('penyusutan') != null && $this->ion_auth->in_group('kalab')){
				$condition['penyusutan'] = 'ya';
			}
			if($this->input->get('pembelian') != null){
				$condition['pembelian'] = 'ya';
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
		$pages = [];
		if(in_array("kalab", $this->groups)){
			$pages = ['Aset' => 'kalab/aset'];
		}else if(in_array("input_admin", $this->groups)){
			$pages = ['Aset' => 'admin/aset'];
		}

        $data = [
			'subtitle' => 'Aset Inventaris',
			'pages' => $pages,

			'user' => $this->user,
			'groups' => $this->groups,
			'assets' => $this->aset_model->get_assets(false, $condition),
			'kategori' => $this->kategori_model->get_categories(),
			'kondisi' => $this->acuan_aset_model->get_acuan(false, 'kondisi'),
			'ruangan' => $this->ruangan_model->get_rooms(),
			'spesifikasi' => $this->spesifikasi_model->get_all_specification(),
		];
        $this->layout->template('admin')->render('aset/index', $data);
	}
	public function create()
    {
		$pages = [];
		if(in_array("kalab", $this->groups)){
			$pages = ['Aset'=>'kalab/aset', 'Create' => 'kalab/aset/create'];
		}else if(in_array("input_admin", $this->groups)){
			$pages = ['Aset'=>'admin/aset', 'Create' => 'admin/aset/create'];
		}
		$this->load->library('barcoder');
		$this->layout->template('admin')->render('aset/create', [
			'errors' => $this->session->flashdata('errors'),

			'kategori' => $this->kategori_model->get_categories(),
			'kategori_khusus' => $this->kategori_khusus_model->get_categories(),
			'kondisi' => $this->acuan_aset_model->get_acuan(false, 'kondisi'),
			'ruangan' => $this->ruangan_model->get_rooms(),
			'user' => $this->user,
			'groups' => $this->groups,
			'subtitle' => 'Aset Inventaris',
			'pages' => $pages,
			'specification' => $this->spesifikasi_model->get_specification(),
			'info_barcode' =>$this->barcoder->getInfo(),
			'total_computer'=>$this->aset_model->get_num_of_computer(),
		]);
	}

	public function store()
    {    
		$this->form_validation->set_rules('kode', 'kode', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('merek', 'merek barang', 'required');
		$this->form_validation->set_rules('kondisi', 'kondisi barang', 'required');
		$this->form_validation->set_rules('ruangan', 'lokasi barang', 'required');
		$this->form_validation->set_rules('kategori', 'kategori barang', 'required');
		$this->form_validation->set_rules('kategori_khusus', 'kategori khusus', 'required');
		$this->form_validation->set_rules('tanggal_penerimaan', 'tanggal penerimaan', 'required');

        if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('errors', validation_errors());
			if(in_array("kalab", $this->groups)){
				redirect('kalab/aset/index');
			}else{
				redirect('admin/aset/index');
			}
		}
		
		//check code exist
		$asset = $this->aset_model->get_assets(false, ['kode' => $this->input->post('kode')]);
		if($asset != null){
			$this->session->set_flashdata('errors', 'Sorry, the item code already exists.');
            if(in_array("kalab", $this->groups)){
				redirect('kalab/aset/index');
			}else{
				redirect('admin/aset/index');
			}
		}

		$data = array( 
			'id_ruangan' => $this->input->post('ruangan'),
			'id_kategori' => $this->input->post('kategori'),
			'id_kategori_khusus' => $this->input->post('kategori_khusus'),
			'kode' => $this->input->post('kode'),
			'nama_aset' => $this->input->post('nama'),
			'merek' => $this->input->post('merek'),
			'kondisi' => $this->input->post('kondisi'),
			'tanggal_penerimaan' => $this->input->post('tanggal_penerimaan'),
			'umur_ekonomis' => $this->input->post('umur_ekonomis'),
			'nilai_aset' => $this->input->post('nilai_aset'),
		);

		if($this->input->post('id_spesifikasi') !== null){
			$data['id_spesifikasi'] = $this->input->post('id_spesifikasi');
		}

		if($this->input->post('nomor_kursi') != null){
			$data['nomor_kursi'] = $this->input->post('nomor_kursi');
		}

		if($this->input->post('nomor_identitas') != null){
			$data['nomor_identitas'] = $this->input->post('nomor_identitas');
		}

		if($this->input->post('keterangan') != null){
			$data['keterangan'] = $this->input->post('keterangan');
		}
		
		if(!empty($_FILES['userfile']['name'])){
			$this->load->helper(['string','config_file']);
			$file_name = string_random(5).'_'.$_FILES['userfile']['name'];
			$file_name = str_replace(' ', '_', $file_name);
			$folder_name = 'aset';

			// Upload Image
			$this->load->library('upload', get_image_configuration($folder_name, $file_name));
	
			if(!$this->upload->do_upload()){
				$this->session->set_flashdata('errors', $this->upload->display_errors());
				if(in_array("kalab", $this->groups)){
					redirect('kalab/aset/index');
				}else{
					redirect('admin/aset/index');
				}
			} else {
				//$data = array('upload_data' => $this->upload->data());
				$data['gambar'] = $file_name;
			}
		}
		$this->aset_model->create_asset($data);

		$this->session->set_flashdata('message', 'Successfully add asset.');
		if(in_array("kalab", $this->groups)){
			redirect('kalab/aset/index');
		}else{
			redirect('admin/aset/index');
		}
	}
	
	public function edit($id)
    {
		$asset = $this->aset_model->get_assets($id);
		$pages = [];
		if(in_array("kalab", $this->groups)){
			$pages = ['Aset' => 'kalab/aset', 'Edit'=>'kalab/aset/edit/'.$id];
		}else if(in_array("input_admin", $this->groups)){
			$pages = ['Aset' => 'admin/aset', 'Edit'=>'admin/aset/edit/'.$id];
		}
        $this->layout->template('admin')->render('aset/edit', [
			'asset' => $asset,
			'kategori' => $this->kategori_model->get_categories(),
			'kategori_khusus' => $this->kategori_khusus_model->get_categories(),
			'kondisi' => $this->acuan_aset_model->get_acuan(false, 'kondisi'),
			'ruangan' => $this->ruangan_model->get_rooms(),
			'specification' => $this->spesifikasi_model->get_specification(),
			'user' => $this->user,
			'groups' => $this->groups,
			
			'subtitle' => "aset",
			'pages' => $pages,
			'header' => "Edit aset '" . $asset['kode'] . "'",
			'info_barcode' =>$this->barcoder->getInfo(),
        ]);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('kode', 'kode', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('merek', 'merek barang', 'required');
		$this->form_validation->set_rules('kondisi', 'kondisi barang', 'required');
		$this->form_validation->set_rules('ruangan', 'lokasi barang', 'required');
		$this->form_validation->set_rules('kategori', 'kategori barang', 'required');
		$this->form_validation->set_rules('kategori_khusus', 'kategori khusus', 'required');
		$this->form_validation->set_rules('tanggal_penerimaan', 'tanggal penerimaan', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            if(in_array("kalab", $this->groups)){
				redirect('kalab/aset/index');
			}else{
				redirect('admin/aset/index');
			}
		}
		
		$data = array( 
			'id' => $id,
			'id_ruangan' => $this->input->post('ruangan'),
			'id_kategori' => $this->input->post('kategori'),
			'id_kategori_khusus' => $this->input->post('kategori_khusus'),
			'id_spesifikasi' => $this->input->post('id_spesifikasi'),
			'kode' => $this->input->post('kode'),
			'nama_aset' => $this->input->post('nama'),
			'merek' => $this->input->post('merek'),
			'kondisi' => $this->input->post('kondisi'),
			'tanggal_penerimaan' => $this->input->post('tanggal_penerimaan'),
			'umur_ekonomis' => $this->input->post('umur_ekonomis'),
			'nilai_aset' => $this->input->post('nilai_aset'),
			'nomor_kursi'=> $this->input->post('nomor_kursi'),
			'nomor_identitas'=> $this->input->post('nomor_identitas'),
			'keterangan'=> $this->input->post('keterangan'),
		);

		if(!empty($_FILES['userfile']['name'])){
			$this->load->helper(['string','config_file']);
			$file_name = string_random(5).'_'.$_FILES['userfile']['name'];
			$file_name = str_replace(' ', '_', $file_name);
			$folder_name = 'aset';

			// Upload Image
			$this->load->library('upload', get_image_configuration($folder_name, $file_name));

			if(!$this->upload->do_upload()){
				$this->session->set_flashdata('errors', $this->upload->display_errors());
				if(in_array("kalab", $this->groups)){
					redirect('kalab/aset/index');
				}else{
					redirect('admin/aset/index');
				}
			} else {
				//$data = array('upload_data' => $this->upload->data());
				$data['gambar'] = $file_name;
			}
		}
        $asset = $this->aset_model->update_asset($data);

        $this->session->set_flashdata('message', "Successfully update asset '" . $asset['kode'] . "'.");
        if(in_array("kalab", $this->groups)){
			redirect('kalab/aset/index');
		}else{
			redirect('admin/aset/index');
		}
    }

    public function delete($id)
    {
        $this->aset_model->delete_asset($id);
        $this->session->set_flashdata('message', 'Successfully delete asset.');
        redirect('kalab/aset/index');
	}

	public function view($id)
	{
		$asset = $this->aset_model->get_assets($id);
		$pages = [];
		if(in_array("kalab", $this->groups)){
			$pages = ['Aset' => 'kalab/aset', 'View'=>'kalab/aset/'.$id];
		}else if(in_array("input_admin", $this->groups)){
			$pages = ['Aset' => 'admin/aset', 'View'=>'admin/aset/'.$id];
		}
        $this->layout->template('admin')->render('aset/detail', [
			'asset' => $asset,
			'history' => $this->riwayat_perbaikan_model->get_history(false,['kode' => $asset['kode']]),
			'specification' => $this->spesifikasi_model->get_specification($asset['id_spesifikasi']),
			'user' => $this->user,
			'groups' => $this->groups,
			'info_barcode' => $this->barcoder->getInfo($asset['nama']),
			
			'subtitle' => "Aset",
			'pages' => $pages,
			'header' => "Aset '" . $asset['nama_aset'] . "'",
        ]);
	}
	
	public function download_template($option='download'){
		$public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
		if($option == 'download'){
			$filename = $public_path.'/assets/templates/upload_assets.xlsx';
		}else{
			$filename = $public_path.'/assets/templates/update_assets.xlsx';
		}

		$spreadsheet = new Spreadsheet();
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($filename);

		$data = [
			'ruangan' => $this->ruangan_model->get_rooms(),
			'kategori' => $this->kategori_model->get_categories(),
			'kategori_khusus' => $this->kategori_khusus_model->get_categories(),
			'spesifikasi' => $this->spesifikasi_model->get_specification(),
		];
		// write ruangan
		$sheet = $spreadsheet->getSheet(0);
		if(!empty($data['ruangan'])){
			foreach($data['ruangan'] as $i=>$ruangan){
				$cell = 'A'. (count($data['ruangan']) - $i + 2);
				unset($ruangan['gambar']);
				unset($ruangan['created_at']);
				unset($ruangan['updated_at']);
				unset($ruangan['deleted_at']);
				$sheet->fromArray(array_values($ruangan), NULL, $cell);
			}
		}

		// write kategori
		$sheet = $spreadsheet->getSheet(1);
		if(!empty($data['kategori'])){
			foreach($data['kategori'] as $i=>$kategori){
				$cell = 'A'. ($i + 3);
				unset($kategori['created_at']);
				unset($kategori['updated_at']);
				unset($kategori['deleted_at']);
				$sheet->fromArray(array_values($kategori), NULL, $cell);
			}
		}

		// write kategori khusus
		$sheet = $spreadsheet->getSheet(2);
		if(!empty($data['kategori_khusus'])){
			foreach($data['kategori_khusus'] as $i=>$kategori_khusus){
				$cell = 'A'. ($i + 3);
				unset($kategori_khusus['ct']);
				$sheet->fromArray(array_values($kategori_khusus), NULL, $cell);
			}
		}

		// write spesifikasi
		$sheet = $spreadsheet->getSheet(3);
		if(!empty($data['spesifikasi'])){
			foreach($data['spesifikasi'] as $i=>$spesifikasi){
				$cell = 'A'. (count($data['spesifikasi']) - $i + 2);
				unset($spesifikasi['created_at']);
				unset($spesifikasi['updated_at']);
				unset($spesifikasi['deleted_at']);
				$sheet->fromArray(array_values($spesifikasi), NULL, $cell);
			}	
		}

		if($option == 'download'){
			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="file.xlsx"');
			$writer->save("php://output");
		}else{
			return $spreadsheet;
		}
	}
	public function upload ($option = 'upload')
	{
		$filename=$_FILES["file"]["tmp_name"];		
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		
		if($_FILES["file"]["size"] > 0 && ($ext === 'xls'||$ext === 'xlsx')){
			$spreadsheet = new Spreadsheet();

			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet = $reader->load($filename);

			$sheet = $spreadsheet->getSheetByName('tbl_aset');
			$highestRow = $sheet->getHighestRow();

			for($i=3; $i<= $highestRow; $i++){
				if($option == 'upload'){
					$range = 'A'.$i.':M'.$i;
					$dataArray = $sheet->rangeToArray(
						$range,     // The worksheet range that we want to retrieve
						NULL,        // Value that should be returned for empty cells
						FALSE,       // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
						TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
						TRUE         // Should the array be indexed by cell row and cell column
					);
					$data = [
						'id_ruangan' => $dataArray[$i]['A'],
						'id_kategori' => $dataArray[$i]['B'],
						'id_kategori_khusus' => $dataArray[$i]['C'],
						'id_spesifikasi' => $dataArray[$i]['D'],
						'kode' => $dataArray[$i]['E'],
						'nama_aset' => $dataArray[$i]['F'],
						'merek' => $dataArray[$i]['G'],
						'tanggal_penerimaan' => date("Y-m-d", strtotime($dataArray[$i]['I'])),
						'umur_ekonomis' => $dataArray[$i]['J'],
						'nilai_aset' => $dataArray[$i]['K'],
						'nomor_kursi' => $dataArray[$i]['L'],
						'nomor_identitas' => $dataArray[$i]['M'],
					];
					if($data['id_ruangan'] !== null){
						if($dataArray[$i]['H'] == 0){$data['kondisi'] = 'baik';}
						else if($dataArray[$i]['H'] == 1){$data['kondisi'] = 'sedang diperbaiki';}
						else if($dataArray[$i]['H'] == 2){$data['kondisi'] = 'dioper ke BTI';}
						else {$data['kondisi'] = 'rusak';}
						
						//format nilai aset
						if(strpos($data['nilai_aset'] , 'Rp') !== false){
							$data['nilai_aset'] = trim(substr($data['nilai_aset'],2));
							$temp = strpos($data['nilai_aset'] , ',00');
							if($temp !== false){
								$data['nilai_aset'] = trim(substr($data['nilai_aset'],0,$temp));
							}
							$temp = strpos($data['nilai_aset'] , '.');
							while($temp != false){
								$data['nilai_aset'] = substr($data['nilai_aset'],0, $temp) . substr($data['nilai_aset'], $temp+1);
								
								$temp = strpos($data['nilai_aset'] , '.');
							}
						}
						
						// random kode
						if($data['kode'] == null){
							$this->load->helper('string');
							$data['kode'] = string_random(4);
						}
						$result = $this->aset_model->create_asset($data);
						$this->session->set_flashdata('message', 'Successfully upload data asset.');
					}
				}else{
					$range = 'A'.$i.':N'.$i;
					$dataArray = $sheet->rangeToArray(
						$range, NULL, FALSE, TRUE, TRUE       
					);
					$data = [
						'id' => $dataArray[$i]['A'],
						'id_ruangan' => $dataArray[$i]['B'],
						'id_kategori' => $dataArray[$i]['C'],
						'id_kategori_khusus' => $dataArray[$i]['D'],
						'id_spesifikasi' => $dataArray[$i]['E'],
						'kode' => $dataArray[$i]['F'],
						'nama_aset' => $dataArray[$i]['G'],
						'merek' => $dataArray[$i]['H'],
						'tanggal_penerimaan' => date("Y-m-d", strtotime($dataArray[$i]['J'])),
						'umur_ekonomis' => $dataArray[$i]['K'],
						'nilai_aset' => $dataArray[$i]['L'],
						'nomor_kursi' => $dataArray[$i]['M'],
						'nomor_identitas' => $dataArray[$i]['N'],
					];
					if($data['id_ruangan'] !== ""){
						if($dataArray[$i]['I'] == 0){$data['kondisi'] = 'baik';}
						else if($dataArray[$i]['I'] == 1){$data['kondisi'] = 'sedang diperbaiki';}
						else if($dataArray[$i]['I'] == 2){$data['kondisi'] = 'dioper ke BTI';}
						else {$data['kondisi'] = 'rusak';}
						
						//format nilai aset
						if(strpos($data['nilai_aset'] , 'Rp') !== false){
							$data['nilai_aset'] = trim(substr($data['nilai_aset'],2));
							$temp = strpos($data['nilai_aset'] , ',00');
							if($temp !== false){
								$data['nilai_aset'] = trim(substr($data['nilai_aset'],0,$temp));
							}
							$temp = strpos($data['nilai_aset'] , '.');
							while($temp != false){
								$data['nilai_aset'] = substr($data['nilai_aset'],0, $temp) . substr($data['nilai_aset'], $temp+1);
								
								$temp = strpos($data['nilai_aset'] , '.');
							}
						}
						$result = $this->aset_model->update_asset($data);
						$this->session->set_flashdata('message', 'Successfully update data asset.');
					}
				}
			}
			
        	if(in_array("kalab", $this->groups)){
				redirect('kalab/aset/index');
			}else{
				redirect('admin/aset/index');
			}
		}
		else{
			$this->session->set_flashdata('errors', "Invalid File:Please Upload XLSX File.");
        	if(in_array("kalab", $this->groups)){
				redirect('kalab/aset/index');
			}else{
				redirect('admin/aset/index');
			}
		}
	}

	public function download($pembelian=false)
	{
		$public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
		$filename = $public_path.'/assets/templates/download_assets.xlsx';

		$spreadsheet = new Spreadsheet();
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($filename);

		// write aset
		$sheet = $spreadsheet->getSheet(0);
		$sheet->setCellValue('A1','Kondisi Aset LAB. Komputasi TIF tanggal '.date("Y-m-d"));
		
		if($pembelian != false){
			$spreadsheet = $this->download_template('get');
			$sheet = $spreadsheet->getSheetByName('tbl_aset');
			$data = $this->aset_model->get_assets(false,['pembelian'=>'ya'],true);
			if(!empty($data)){
				foreach($data as $i=>$aset){
					$cell = 'A'. (count($data) - $i + 2);
					$temp = [$aset['id'], '', '', '', '',$aset['kode'], $aset['nama_aset'],
					'', '', $aset['tanggal_penerimaan'], $aset['nilai_aset']];
					$sheet->fromArray($temp, NULL, $cell);
				}
			}else{
				$this->session->set_flashdata('errors', "No assets found");
				if(in_array("kalab", $this->groups)){
					redirect('kalab/aset?pembelian=ya');
				}else{
					redirect('admin/aset?pembelian=ya');
				}
			}
		}else{
			$data = $this->aset_model->get_assets(false,[],true);
			if(!empty($data)){
				foreach($data as $i=>$aset){
					$cell = 'A'. (count($data) - $i + 2);
					$temp = [$aset['id'], $aset['kode'], $aset['nama_aset'],
							$aset['merek'], $aset['tanggal_penerimaan'], $aset['nomor_kursi'], $aset['nomor_identitas'],
							$aset['nama'], $aset['ruangan'], $aset['nama_kategori'], $aset['nama_kategori_khusus']];
					$sheet->fromArray($temp, NULL, $cell);
				}
			}
		}

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="aset_LAB_TIF_'.date("Y-m-d").'.xlsx"');
		$writer->save("php://output");
	}

	public function download_image($id)
	{
		$this->load->helper('download');
		$file_name = $this->aset_model->get_assets($id)['gambar'];
		if($file_name == null){
			$this->session->set_flashdata('errors', "No image found.");
        	redirect('kalab/aset/index');
		}
		$public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
		$download_path = $public_path.'/assets/images/aset/'.$file_name;
		force_download($download_path, NULL);
	}
}

