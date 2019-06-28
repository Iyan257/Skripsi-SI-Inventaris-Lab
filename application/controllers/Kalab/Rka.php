<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rka extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->in_group('kalab')) {
            show_404();
        }
		$this->load->library(['session']);
		$this->load->model(['aset_model', 'rka_model','rka_aset_model', 'rka_aset_temp_model', 'notifikasi_model', 'permintaan_model']);
	}
	
	public function index()
	{ 
		$like=[];
		if($_SERVER['REQUEST_METHOD']=='GET'){
			if($this->input->get('search_by') != null && $this->input->get('query') != null){
				if($this->input->get('search_by') == "title"){
					$like['judul'] = $this->input->get('query');
					$this->session->set_flashdata('message', "Show result where the title contains '".$this->input->get('query')."'.");
				}
				if($this->input->get('search_by') == "sender"){
					$like['inisial'] = $this->input->get('query');
					$this->session->set_flashdata('message', "Show result where the sender have initials as '".$this->input->get('query')."'.");
				}
				if($this->input->get('search_by') == "year"){
					$like['rencana_tahun'] = $this->input->get('query');
					$this->session->set_flashdata('message', "Show result where the year is '".$this->input->get('query')."'.");
				}
			}else if($this->input->get('id_permintaan') != null){
				$this->permintaan_model->update_request(['id'=> $this->input->get('id_permintaan'), 'dibaca'=>'1']);
			}
		}
        $data = [
			'subtitle' => 'Rencana Kerja Anggaran',
			'pages' => ['RKA'=>'kalab/rka'],
			'user' => $this->user,
			
			'history' => $this->rka_model->get_history(),
			'request' => $this->permintaan_model->get_request(false, false, $like),	
        ];
        $this->layout->template('admin')->render('rka/index', $data);
	}
	public function create()
    {
		if($this->input->post('delete')){
			// delete item
			$this->rka_aset_temp_model->delete_item(false, $this->input->post('delete'));
		}else{
			// create item
			$n = $this->input->post('banyak');
			if($this->input->post('kegiatan')){
				$data = [
					'id_user' => $this->user->id,
					'kegiatan' => $this->input->post('kegiatan'),
					'nama_barang' => $this->input->post('nama_barang'),
					'banyak' => $this->input->post('banyak'),
					'satuan' => $this->input->post('satuan'),
					'perkiraan_biaya' => $this->input->post('perkiraan_biaya') * $n,
					'latar_belakang' => $this->input->post('latar_belakang'),
				];
				$this->rka_aset_temp_model->create_item($data);
				
			}else{
				$this->rka_aset_temp_model->delete_item($this->user->id);
			}
		}
		$data = [
			'errors' => $this->session->flashdata('errors'),
			'pages' => ['RKA'=>'kalab/rka','Create'=>'kalab/rka/create'],
			'user' => $this->user,
			'subtitle' => "Rencana Kerja Anggaran",
			'total_biaya' => $this->rka_aset_temp_model->get_sum_biaya($this->user->id)['sum_biaya'],

			'items' => $this->rka_aset_temp_model->get_items(false,['id_user'=>$this->user->id]),
		];
		if($this->input->post('judul')){
			$data['judul'] = $this->input->post('judul');
		}
		$this->layout->template('admin')->render('rka/create', $data);
		
	}

	public function store()
    {   
		$this->form_validation->set_rules('judul', 'judul RKA', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('kalab/rka/create');
		}
		
		$data = array( 
			'judul' => $this->input->post('judul'),
		);
		if($this->input->post('total_biaya') != null){
			$data['total_anggaran'] = $this->input->post('total_biaya');
		}

		$rka = $this->rka_model->create_history($data);
		$items = $this->rka_aset_temp_model->get_items(false,['id_user'=>$this->user->id]);

		foreach($items as $i){
			$data = [
				'id_rka' => $rka['id'],
				'kegiatan' => $i['kegiatan'],
				'nama_barang' => $i['nama_barang'],
				'banyak' => $i['banyak'],
				'satuan' => $i['satuan'],
				'perkiraan_biaya' => $i['perkiraan_biaya'],
				'latar_belakang' => $i['latar_belakang'],
				'status' => 'diproses',
			];
			$this->rka_aset_model->create_rka_aset($data);
		}

		// delete table temp
		$this->rka_aset_temp_model->delete_item($this->user->id);
		$this->session->set_flashdata('message', "Successfully add new 'RKA'.");
		redirect('kalab/rka/index');
	}

	public function edit($id)
    {
		// id aksi 
		// 0 = item sudah disimpan sebelumnya di tabel rka_aset
		// 1 = item baru ditambahkan
		// 2 = item baru diupdate
		// 3 = item telah dihapus
		if($this->input->post('delete')){
			// delete item
			$item = $this->rka_aset_temp_model->get_items($this->input->post('delete'));
			if($item['id_rka_aset'] === null){
				$this->rka_aset_temp_model->delete_item(false, $item['id']);
			}else {
				$this->rka_aset_temp_model->update_item(['id'=>$item['id'] , 'id_aksi'=>'3']);
			}
		}
		else if($this->input->post('update_status_disetujui')){
			// untuk status disetujui dan/atau berubah
			$item = $this->rka_aset_temp_model->get_items($this->input->post('update_status_disetujui'));
			if($item['id_rka_aset'] === null){
				$id_aksi = 1;
			}else {$id_aksi = 2;}

			if($this->input->post('same_option') == "same"){
				$this->rka_aset_temp_model->update_item(['id'=>$item['id'] , 'id_aksi'=>$id_aksi, 'banyak_disetujui'=>$item['banyak'], 'satuan_disetujui'=>$item['satuan'], 'status'=>'disetujui']);
			} else if($this->input->post('same_option') == "change"){
				$this->rka_aset_temp_model->update_item(['id'=>$item['id'] , 'id_aksi'=>$id_aksi, 'banyak_disetujui'=>$this->input->post('banyak_disetujui'), 'satuan_disetujui'=>$this->input->post('satuan_disetujui'), 'status'=>'disetujui']);
			}
		}
		else if($this->input->post('update_harga_disetujui')){
			// untuk status disetujui dan terealisasi
			$item = $this->rka_aset_temp_model->get_items($this->input->post('update_harga_disetujui'));
			if($item['id_rka_aset'] === null){
				$id_aksi = 1;
			}else {$id_aksi = 2;}

			
			if($item['banyak_disetujui'] == null){
				$harga_satuan = $this->input->post('harga_satuan');
				$total_harga = $harga_satuan * $item['banyak'];
				$this->rka_aset_temp_model->update_item(['id'=>$item['id'], 'banyak_disetujui'=>$item['banyak'], 'satuan_disetujui'=>$item['satuan'], 'id_aksi'=>$id_aksi, 'total_terealisasi'=> $total_harga, 'status'=>'disetujui_terealisasi']);
			}else{
				$harga_satuan = $this->input->post('harga_satuan');
				$total_harga = $harga_satuan * $item['banyak_disetujui'];
				$this->rka_aset_temp_model->update_item(['id'=>$item['id'], 'id_aksi'=>$id_aksi, 'total_terealisasi'=> $total_harga, 'status'=>'disetujui_terealisasi']);
			}
		}
		else if($this->input->post('update_status')){
			// update status item
			$item = $this->rka_aset_temp_model->get_items($this->input->post('update_status'));
			if($item['id_rka_aset'] === null){
				$id_aksi = 1;
			}else {$id_aksi = 2;}

			if($this->input->post('status') == "ditolak"){
				$this->rka_aset_temp_model->update_item(['id'=>$item['id'] , 'id_aksi'=>$id_aksi, 'status'=>$this->input->post('status'), 'banyak_disetujui'=>0, 'satuan_disetujui'=>'-', 'total_terealisasi'=>0]);
			}
			else{
				$this->rka_aset_temp_model->update_item(['id'=>$item['id'] , 'id_aksi'=>$id_aksi, 'status'=>$this->input->post('status')]);
			}
		}
		else{
			// create item
			if($this->input->post('kegiatan')){
				$n = $this->input->post('banyak');
				$data = [
					'id_user' => $this->user->id,
					'kegiatan' => $this->input->post('kegiatan'),
					'nama_barang' => $this->input->post('nama_barang'),
					'banyak' => $this->input->post('banyak'),
					'satuan' => $this->input->post('satuan'),
					'perkiraan_biaya' => $this->input->post('perkiraan_biaya') * $n,
					'latar_belakang' => $this->input->post('latar_belakang'),
					'id_aksi' => '1',
					'status' => 'diproses',
				];
				$this->rka_aset_temp_model->create_item($data);
				
			}else{
				$this->rka_aset_temp_model->delete_item($this->user->id);
				$items = $this->rka_aset_model->get_rka_aset(false, $id);
				foreach($items as $i){
					$temp = [
						'id_user' => $this->user->id,
						'id_rka_aset' => $i['id'],
						'kegiatan' => $i['kegiatan'],
						'nama_barang' => $i['nama_barang'],
						'banyak' => $i['banyak'],
						'satuan' => $i['satuan'],
						'perkiraan_biaya' => $i['perkiraan_biaya'],
						'latar_belakang' => $i['latar_belakang'],
						'status' => $i['status'],
						'id_aksi' => '0',
						'banyak_disetujui' => $i['banyak_disetujui'],
						'satuan_disetujui' => $i['satuan_disetujui'],
						'total_terealisasi' => $i['total_terealisasi'],
					];
					$this->rka_aset_temp_model->create_item($temp);
				}
			}
		}
		$data = [
			'id' => $id,
			'errors' => $this->session->flashdata('errors'),
			'pages' => ['RKA' => 'kalab/rka', 'Edit' => 'kalab/rka/edit/'.$id],
			'user' => $this->user,
			'subtitle' => "Rencana Kerja Anggaran",
			'header' => "Edit RKA '" .$id. "'",
			'total_biaya' => $this->rka_aset_temp_model->get_sum_biaya($this->user->id)['sum_biaya'],
			'total_terealisasi' => $this->rka_aset_temp_model->get_sum_biaya($this->user->id)['sum_terealisasi'],

			'rka' => $this->rka_model->get_history($id),
			'items' => $this->rka_aset_temp_model->get_items(false,['id_aksi !='=>'3']),
		];
		if($this->input->post('judul')){
			$data['judul'] = $this->input->post('judul');
		}
		$this->layout->template('admin')->render('rka/edit', $data);
    }

    public function update($id)
    {
		$this->form_validation->set_rules('judul', 'judul RKA', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('kalab/rka/index');
		}
		
		$data = array( 
			'id' => $id,
			'judul' => $this->input->post('judul'),
		);
		if($this->input->post('total_biaya') != null){
			$data['total_anggaran'] = $this->input->post('total_biaya');
		}
		if($this->input->post('total_terealisasi') != null){
			$data['total_terealisasi'] = $this->input->post('total_terealisasi');
		}
		if($this->input->post('total_terealisasi') != null){
			$data['total_terealisasi'] = $this->input->post('total_terealisasi');
		}

		$rka = $this->rka_model->update_history($data);
		$items = $this->rka_aset_temp_model->get_items(false,['id_user'=>$this->user->id]);

		
		foreach($items as $i){
			if($i['id_aksi'] == '3'){
				// telah dihapus
				$this->rka_aset_model->delete_rka_aset(false, $i['id_rka_aset']);
			}
			else if($i['id_aksi'] == '2' || $i['id_aksi'] == '1'){
				// baru ditambahkan
				$data = [
					'id_rka' => $id,
					'kegiatan' => $i['kegiatan'],
					'nama_barang' => $i['nama_barang'],
					'banyak' => $i['banyak'],
					'satuan' => $i['satuan'],
					'perkiraan_biaya' => $i['perkiraan_biaya'],
					'latar_belakang' => $i['latar_belakang'],
					'status' => $i['status'],
					'banyak_disetujui' => $i['banyak_disetujui'],
					'satuan_disetujui' => $i['satuan_disetujui'],
					'total_terealisasi' => $i['total_terealisasi'],
				];
								
				$rka_aset = $this->rka_aset_model->get_rka_aset($i['id_rka_aset']);
				if(($rka_aset['status'] !== "disetujui_terealisasi" || $i['id_aksi'] == '1') && $data['status'] === "disetujui_terealisasi"){
					// sebelumnya belum ditandai sudah terealisasi
					if($i['banyak_disetujui'] !== null){
						$n = $i['banyak_disetujui'];
						if($i['satuan_disetujui'] == 'lusin'){
							$n *= 12;
						}else if($i['satuan_disetujui'] == 'gross'){
							$n *= 144;
						}else if($i['satuan_disetujui'] == 'kodi'){
							$n *= 20;
						}else if($i['satuan_disetujui'] == 'rim'){
							$n *= 500;
						}
					}else{
						$n = $i['banyak'];
						if($i['satuan'] == 'lusin'){
							$n *= 12;
						}else if($i['satuan'] == 'gross'){
							$n *= 144;
						}else if($i['satuan'] == 'kodi'){
							$n *= 20;
						}else if($i['satuan'] == 'rim'){
							$n *= 500;
						}
					}
					$harga = $i['total_terealisasi'] / $n;
					$this->create_assets($n, $i['nama_barang'], $harga);
				}

				if($i['id_aksi'] == '2'){
					$data['id'] = $i['id_rka_aset'];
					$this->rka_aset_model->update_rka_aset($data);
				}else{
					$this->rka_aset_model->create_rka_aset($data);
				}
			}
		}

		// delete table temp
		$this->rka_aset_temp_model->delete_item($this->user->id);
		$this->session->set_flashdata('message', "Successfully edit '".$rka['judul']."'.");
		redirect('kalab/rka/index');
    }

	private function create_assets($n, $nama_barang, $harga){
		$this->load->helper(['date','string']);
		for($i=0; $i<$n; $i++){
			$aset = [
				'kode' => string_random(4),
				'nama_aset' => $nama_barang,
				'tanggal_penerimaan' => mdatenow(),
				'nilai_aset' => $harga,
			];
			$this->aset_model->create_asset($aset);
		}
		$notification = [
			'judul' => 'Terdapat aset baru yang sudah terealisasi.',
			'deskripsi' => 'Terdapat '.$n.' aset yang harus dilengkapi datanya.',
			'tipe' => 'pembelian',
			'user_group' => ['input_admin'],
		];
		
		$this->notifikasi_model->create_notification($notification);
	}
    public function delete($id)
    {
		$this->rka_aset_model->delete_rka_aset($id);
        $this->rka_model->delete_history($id);
        $this->session->set_flashdata('message', "Successfully delete 'RKA'.");
        redirect('kalab/rka/index');
	}
}
