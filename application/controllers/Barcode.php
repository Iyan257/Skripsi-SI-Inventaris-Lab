<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Barcode extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('kalab') && !$this->ion_auth->in_group('input_admin')) {
            show_404();
        }
		$this->load->helper('form');
		$this->load->library(['session', 'form_validation','layout', 'barcoder']);
		$this->load->model(['aset_model']);
	}
	public function index()
	{
		$data = [
            'subtitle' => 'Barcode',
            'pages' => ['Create Barcode' => 'barcode'],

			'user' => $this->user,
        ];
		$this->layout->template('admin')->render('barcode/index', $data);
	}
	
	public function getBarcode($kode){
		$this->barcoder->getBarcode($kode);
	}

	public function getQRCode($kode){
		$text = 'http://192.168.1.2:1240/'.'stock_opname_api?kode='.$kode;
		$this->barcoder->getQRCode($text);
	}

	public function getBarcodeBase64($kode){
		return 'data:image/png;base64,'.$this->barcoder->getBarcodeBase64($kode);
	}

	public function getQRCodeBase64($kode){
		$text = 'http://192.168.1.2:1240/'.'stock_opname_api?kode='.$kode;
		return 'data:image/png;base64,'.$this->barcoder->getQRCodeBase64($text);
	}

	public function create_many(){
		$colors = array_values($this->barcoder->getInfo());
		$temp = '';
		foreach($colors as $i=> $c){
			if($i>0)$temp.='|';
			$temp .= preg_replace('/\s+/', '', $c['lab']).'='. substr($c['color'],1);
		}
		$data['info_barcode'] = $temp;
		$data['info'] = [];

		if($this->input->post('id_select')){
			$arr = explode(",", $this->input->post('id_select'));

			foreach($arr as $a){
				$a = trim($a);
				if (strpos($a, '-') !== false) {
					$start = explode("-",$a)[0];
					$end = explode("-",$a)[1];
					for($i=$start; $i<=$end; $i++){
						$asset = $this->aset_model->get_assets($i);
						if(isset($asset)){
							$temp = [
								'kode' => $asset['kode'],
								'merek' => $asset['merek'],
								'tahun_pembelian' => substr($asset['tanggal_penerimaan'],0,4),
								'kategori' => $asset['nama_kategori_khusus'],
								'warna_label' => $asset['warna_label'],
								'nomor_kursi' => $asset['nomor_kursi'],
								'nomor_identitas' => $asset['nomor_identitas'],
								'info_barcode' => $this->barcoder->getInfo($asset['nama']),
							];
							array_push($data['info'], $temp);
						}
					}
				}else{
					$asset = $this->aset_model->get_assets($a);
					if(isset($asset)){
						$temp = [
							'kode' => $asset['kode'],
							'merek' => $asset['merek'],
							'tahun_pembelian' => substr($asset['tanggal_penerimaan'],0,4),
							'kategori' => $asset['nama_kategori_khusus'],
							'warna_label' => $asset['warna_label'],
							'nomor_kursi' => $asset['nomor_kursi'],
							'nomor_identitas' => $asset['nomor_identitas'],
							'info_barcode' => $this->barcoder->getInfo($asset['nama']),
						];
						array_push($data['info'], $temp);
					}
				}
			}
		}else{
			// kode
			$arr = explode(",", $this->input->post('kode_select'));

			foreach($arr as $a){
				$a = trim($a);
				
				$asset = $this->aset_model->get_assets(false, ['kode'=>$a])[0];
				if(isset($asset)){
					$temp = [
						'kode' => $asset['kode'],
						'merek' => $asset['merek'],
						'tahun_pembelian' => substr($asset['tanggal_penerimaan'],0,4),
						'kategori' => $asset['nama_kategori_khusus'],
						'warna_label' => $asset['warna_label'],
						'nomor_kursi' => $asset['nomor_kursi'],
						'nomor_identitas' => $asset['nomor_identitas'],
						'info_barcode' => $this->barcoder->getInfo($asset['nama']),
					];
					array_push($data['info'], $temp);
				}
			}
		}
		if(empty($data['info'])){
			$this->session->set_flashdata('errors', 'Sorry, no assets match.');
			redirect('barcode');
		}
		$this->load->view('barcode/many', $data);
	}

	public function create_from_excel(){
		$colors = array_values($this->barcoder->getInfo());
		$temp = '';
		foreach($colors as $i=> $c){
			if($i>0)$temp.='|';
			$temp .= preg_replace('/\s+/', '', $c['lab']).'='. substr($c['color'],1);
		}
		$data['info_barcode'] = $temp;

		$filename=$_FILES["file"]["tmp_name"];		
		$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
		
		if($_FILES["file"]["size"] > 0 && ($ext === 'xls'||$ext === 'xlsx')){
			$spreadsheet = new Spreadsheet();

			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$spreadsheet = $reader->load($filename);

			$sheet = $spreadsheet->getSheetByName('tbl_aset');
			$highestRow = $sheet->getHighestRow();

			$data['info'] = [];

			for($i=3; $i<= $highestRow; $i++){
				$range = 'A'.$i.':L'.$i;
				$dataArray = $sheet->rangeToArray(
					$range,     // The worksheet range that we want to retrieve
					NULL,        // Value that should be returned for empty cells
					FALSE,       // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
					TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
					TRUE         // Should the array be indexed by cell row and cell column
				);
				if($dataArray[$i]['L']=="1"){
					$asset = $this->aset_model->get_assets(false, ['kode'=> $dataArray[$i]['B']])[0];
					$temp = [
						'kode' => $dataArray[$i]['B'],
						'merek' => $dataArray[$i]['D'],
						'tahun_pembelian' => substr($dataArray[$i]['E'],0,4),
						'kategori' => $dataArray[$i]['K'],
						'warna_label' => $asset['warna_label'],
						'nomor_kursi' => $dataArray[$i]['F'],
						'nomor_identitas' => $dataArray[$i]['G'],
						'info_barcode' => $this->barcoder->getInfo($dataArray[$i]['H']),
						'type' => 'html',
						'barcode' => $this->getBarcodeBase64($dataArray[$i]['B']),
						'qrcode' => $this->getQRCodeBase64($dataArray[$i]['B'], $dataArray[$i]['E'], $dataArray[$i]['D']),
					];
					array_push($data['info'], $temp);
				}
			}
			$this->load->library('pdf');
		
			$this->pdf->setPaper('A4', 'potrait');
			$this->pdf->filename = 'barcodes.pdf';
			$this->load->view('barcode/many', $data);
		}
		else{
			$this->session->set_flashdata('errors', "Invalid File:Please Upload XLSX or XLS File.");
			redirect('barcode/index');
		}
	}

	public function download_assets()
	{
		$public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
		$filename = $public_path.'/assets/templates/upload_assets_barcode.xlsx';

		$spreadsheet = new Spreadsheet();
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($filename);

		$data = $this->aset_model->get_assets(false,[],true);

		// write aset
		$sheet = $spreadsheet->getSheet(0);
		if(!empty($data)){
			foreach($data as $i=>$aset){
				$cell = 'A'. (count($data) - $i + 2);
				$temp = [$aset['id'], $aset['kode'], $aset['nama_aset'],
						$aset['merek'], $aset['tanggal_penerimaan'], $aset['nomor_kursi'], $aset['nomor_identitas'],
						$aset['nama'], $aset['ruangan'], $aset['nama_kategori'], $aset['nama_kategori_khusus']];
				$sheet->fromArray($temp, NULL, $cell);
			}
		}

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="file.xlsx"');
		$writer->save("php://output");
	}
}
