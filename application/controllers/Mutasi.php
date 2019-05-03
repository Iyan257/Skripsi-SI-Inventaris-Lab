<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('kalab') && !$this->ion_auth->in_group('input_admin')) {
            show_404();
        }
		$this->load->library(['session']);
		$this->load->model(['kategori_model','ruangan_model','aset_model','mutasi_model','mutasi_aset_model']);
	}
	
	public function index()
	{
		
        $data = [
			'subtitle' => 'Mutasi',
			'pages' => ['Mutasi'=>'mutasi'],
			'user' => $this->user,
			
			'ruangan' => $this->ruangan_model->get_rooms(),
			'history' => $this->mutasi_model->get_history(),
        ];
        $this->layout->template('admin')->render('mutasi/index', $data);
	}
	public function create()
    {
		$condition = [];

		if($_SERVER['REQUEST_METHOD']=='GET'){
			$condition['id_ruangan'] = $this->session->tempdata('ruangan_asal');
			if($this->input->get('kode') != null){
				$condition['kode'] = $this->input->get('kode');
			}
			if($this->input->get('kategori') != null){
				$condition['aset.id_kategori'] = $this->input->get('kategori');
			}
			if($this->input->get('thn_pembelian') != null){
				$condition['year(tanggal_penerimaan)'] = $this->input->get('thn_pembelian');
			}
			if($this->input->get('kondisi') != null){
				$condition['kondisi'] = $this->input->get('kondisi');
			}
		}else{
			$condition['id_ruangan'] = $this->input->post('ruangan_asal');
			$this->session->set_tempdata('ruangan_asal', $this->input->post('ruangan_asal'), 300);
			$this->session->set_tempdata('ruangan_tujuan', $this->input->post('ruangan_tujuan'), 300);
			$this->session->set_tempdata('keterangan', $this->input->post('keterangan'), 300);
		}

        $this->layout->template('admin')->render('mutasi/create', [
            'errors' => $this->session->flashdata('errors'),
			'pages' => ['Mutasi'=>'mutasi','Create'=>'mutasi/create'],
            'user' => $this->user,
			'subtitle' => 'Pilih Aset',
			
			'assets' => $this->aset_model->get_assets(false, $condition),
			'kategori' => $this->kategori_model->get_categories(),
			'ruangan' => $this->ruangan_model->get_rooms($this->session->tempdata('ruangan_asal')),
			
        ]);
	}

	public function store()
    {    		
		$data = array( 
			'id_ruangan_asal' => $this->session->tempdata('ruangan_asal'),
			'id_ruangan_tujuan' => $this->session->tempdata('ruangan_tujuan'),
			'keterangan' => $this->session->tempdata('keterangan'),
			'created_by' => $this->user->id,
			'updated_by' => $this->user->id,
		);

		if($data['id_ruangan_asal']==null){
			$this->session->set_flashdata('errors', 'Session for mutation asset is expired');
            redirect('mutasi/index');
		}

		$mutasi = $this->mutasi_model->create_history($data);

		foreach($this->input->post('selection') as $aset){
			$data = array( 
				'id_mutasi' => $mutasi['id'],
				'id_aset' => $aset,
			);
			$this->mutasi_aset_model->create_mutasi_aset($data);
			$this->aset_model->update_asset(['id'=> $aset ,'id_ruangan'=> $this->session->tempdata('ruangan_tujuan')]);
		}

		$this->session->set_flashdata('message', 'Successfully move assets.');
		redirect('mutasi/index');
	}
	
	public function edit($id)
    {
		$assets = $this->mutasi_model->get_assets($id);
		$history = $this->mutasi_model->get_history($id);
        $this->layout->template('admin')->render('mutasi/edit', [
			'id' => $id,
			'user' => $this->user,
			'subtitle' => "Mutasi",
			'pages' => ['Mutasi' => 'mutasi', 'Edit' => 'mutasi/edit/'.$id],
			'header' => "Edit Mutasi '" .$id. "'",
			
			'history' => $history,
			'created_user' => $this->ion_auth->user($history['created_by'])->row(),
			'last_updated_user' => $this->ion_auth->user($history['updated_by'])->row(),
			'assets' => $assets,
			'ruangan' => $this->ruangan_model->get_rooms(),
        ]);
    }

    public function update($id)
    {
		$data = array( 
			'id' => $id,
			'id_ruangan_asal' => $this->input->post('ruangan_asal'),
			'id_ruangan_tujuan' => $this->input->post('ruangan_tujuan'),
			'keterangan' => $this->input->post('keterangan'),
			'updated_by' => $this->user->id,
		);
		$mutasi = $this->mutasi_model->update_history($data);
		
		$assets = $this->mutasi_model->get_assets($id);
		$updated_asset = $this->input->post('selection');
		
		//kembalikan lokasi ruangan aset yang tidak jadi dimutasi
		foreach($assets as $a){
			if(!in_array($a['id'], $updated_asset)){
				$this->aset_model->update_asset(['id'=> $a['id'] ,'id_ruangan'=> $this->input->post('ruangan_asal')]);
			}
		}
		
		//hapus semua riwayat yang lama
		$this->mutasi_aset_model->delete_mutasi_aset($id);

		foreach($updated_asset as $aset){
			$data = array( 
				'id_mutasi' => $id,
				'id_aset' => $aset,
			);
			$this->mutasi_aset_model->create_mutasi_aset($data);
			$this->aset_model->update_asset(['id'=> $aset ,'id_ruangan'=> $this->input->post('ruangan_tujuan')]);
		}

		$this->session->set_flashdata('message', 'Successfully update mutation history.');
		redirect('mutasi/index');

    }

    public function delete($id)
    {
        $this->mutasi_model->delete_history($id);
        $this->session->set_flashdata('message', 'Successfully delete mutation history.');
        redirect('mutasi/index');
    }
}
