<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->in_group('kalab')) {
            show_404();
        }
		$this->load->library(['session']);
		$this->load->model(['kategori_model','ruangan_model','aset_model','riwayat_perbaikan_model', 'stock_opname_model']);
	}
	public function index()
	{
	}
	
	public function stock_opname ()
	{
		if($this->input->get('option') != null){
			if($this->input->get('option') == 'mulai'){
				$this->stock_opname_model->delete_all();
				$this->stock_opname_model->set_status(1);
				redirect('laporan/stock_opname');
			}else if($this->input->get('option') == 'download'){
				if($this->stock_opname_model->check_last_so()){
					$this->laporan_so();
					return;
				}else{
					$this->session->set_flashdata('errors', 'Sorry, there is no history of the last stock opname.');
					redirect('laporan/stock_opname');
				}
			}
			else{
				$this->stock_opname_model->set_status(0);
				$this->laporan_so();
				return;
			}
		}
		$data = [
			'subtitle' => 'Stock Opname',
			'pages' => ['Stock opname' => 'laporan/stock_opname'],

			'user' => $this->user,
			'groups' => $this->groups,
			'status_so' => $this->stock_opname_model->get_status(),
		];
		$this->layout->template('admin')->render('stock_opname', $data);
	}

	public function laporan_so()
	{
		$public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
		$filename = $public_path.'/assets/templates/stock_opname.xlsx';

		$spreadsheet = new Spreadsheet();
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($filename);
		$sheet = $spreadsheet->getSheet(0);

		$data = $this->stock_opname_model->get_all_assets();
		// write aset
		if(!empty($data)){
			$sheet->setCellValue('A1','Laporan Stock Opname LAB. Komputasi TIF tanggal '.date("Y-m-d"));
			$temp = ''; $pos = 3;
			foreach($data as $i => $aset){
				$cell = 'A'. $pos;
				if($aset['nama_kategori_khusus'] != $temp){
					if($aset['nama_kategori_khusus']==''){
						$sheet->setCellValue($cell, 'Tidak ada kategori');
					}else{
						$sheet->setCellValue($cell, $aset['nama_kategori_khusus']);
					}
					$pos += 1;
					$cell = 'A'. $pos;
					$temp = $aset['nama_kategori_khusus'];
				}
				$sheet->fromArray(array_values($aset), NULL, $cell);
				$pos +=1; 
			}
		}

		// assets not available
		$data = $this->stock_opname_model->get_unmark_assets();
		$sheet = $spreadsheet->getSheet(1);
		$sheet->setCellValue('A1','Laporan Stock Opname LAB. Komputasi TIF tanggal '.date("Y-m-d"));
		if(!empty($data)){
			$temp = ''; $pos = 3;
			foreach($data as $i => $aset){
				$cell = 'A'. $pos;
				if($aset['nama_kategori_khusus'] != $temp){
					if($aset['nama_kategori_khusus']==''){
						$sheet->setCellValue($cell, 'Tidak ada kategori');
					}else{
						$sheet->setCellValue($cell, $aset['nama_kategori_khusus']);
					}
					$pos += 1;
					$cell = 'A'. $pos;
					$temp = $aset['nama_kategori_khusus'];
				}
				$sheet->fromArray(array_values($aset), NULL, $cell);
				$pos +=1; 
			}
		}
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="stock_opname_'.date("Y-m-d").'.xlsx"');
		$writer->save("php://output");
	}

	public function laporan_ketersediaan()
	{
		$public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
		$filename = $public_path.'/assets/templates/download_assets.xlsx';

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
						$aset['merek'], $aset['tanggal_penerimaan'], $aset['nomor_kursi'],
						$aset['nama'], $aset['ruangan'], $aset['nama_kategori'], $aset['nama_kategori_khusus']];
				$sheet->fromArray($temp, NULL, $cell);
			}
		}
		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="laporan.pdf"');
		$writer->save("php://output");
    }
    public function laporan_kerusakan()
	{
		$data = [
            'assets' => $this->aset_model->get_assets(false,['kondisi'=>'sedang diperbaiki'],true),
            'title' => 'Laporan Daftar Kerusakan Aset',
        ];
		$this->load->library('pdf');
		
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->filename = 'laporan_kerusakan.pdf';
		$this->pdf->load_view('laporan/laporan_aset', $data);
        
		//return $pdf->download('aset/laporan');
	}
	public function laporan_aset_di_BTI()
	{
		$data = [
            'assets' => $this->aset_model->get_assets(false,['kondisi'=>'dioper ke BTI'],true),
            'title' => 'Laporan Daftar Aset di BTI',
        ];
		$this->load->library('pdf');
		
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->filename = 'laporan_aset_BTI.pdf';
		$this->pdf->load_view('laporan/laporan_aset', $data);
        
		//return $pdf->download('aset/laporan');
	}
}

