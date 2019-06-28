<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perbaikan extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('kalab') && !$this->ion_auth->in_group('input_admin')) {
            show_404();
        }
		$this->load->library(['session']);
		$this->load->model(['aset_model', 'acuan_aset_model', 'riwayat_perbaikan_model','notifikasi_model']);
	}
	
	public function index($id=false)
	{
		
        $data = [
			'subtitle' => 'Perbaikan',
			'pages' => ['Perbaikan'=>'perbaikan'],
            'user' => $this->user,
            'groups' => $this->groups,
        ];
        if($id !== false){
            $data['history'] = [$this->riwayat_perbaikan_model->get_history($id)];
        }else{
            $data['history'] = $this->riwayat_perbaikan_model->get_history();
        }
        $aset_diperbaiki = [];
        foreach($data['history'] as $h){
            array_push($aset_diperbaiki, $this->aset_model->get_assets(false,['kode'=>$h['kode']])[0]);
        }
        $data['aset_diperbaiki'] = $aset_diperbaiki;
        $this->layout->template('admin')->render('perbaikan/index', $data);
	}
	public function create()
    {
        $this->layout->template('admin')->render('perbaikan/create', [
            'errors' => $this->session->flashdata('errors'),
			'pages' => ['Perbaikan'=>'perbaikan','Create'=>'perbaikan/create'],
            'user' => $this->user,
			'subtitle' => 'Perbaikan',
        ]);
	}

	public function store()
    {    
        $this->form_validation->set_rules('kode', 'kode aset', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'tanggal masuk', 'required');
        $this->form_validation->set_rules('masalah', 'masalah', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('perbaikan/index');
		}
        
        //cek apakah kode barang ada di basis data
        $aset = $this->aset_model->get_assets(false,['kode'=> $this->input->post('kode')]);
        if(empty($aset)){
            $this->session->set_flashdata('errors', 'Tidak ditemukan kode barang yang sesuai.');
            redirect('perbaikan/index');
        }

        //cek apakah kode barang saat ini sudah dalam status sedang diperbaiki
        if($aset[0]['kondisi'] == 'sedang diperbaiki'){
            $this->session->set_flashdata('errors', "Aset saat ini sudah dalam status 'sedang diperbaiki'.");
            redirect('perbaikan/index');
        }else if($aset[0]['kondisi'] == 'dioper ke BTI'){
            $this->session->set_flashdata('errors', "Aset saat ini sudah dalam status 'dioper ke BTI'.");
            redirect('perbaikan/index');
        }

		$data = [ 
            'id_aset' => $aset[0]['id'],
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'masalah' => $this->input->post('masalah'),
            'created_by' => $this->user->id,
			'updated_by' => $this->user->id,
        ];
        if($this->input->post('keterangan') != null){
            $data['keterangan'] = $this->input->post('keterangan');
        }


        if(!empty($_FILES['userfile']['name'])){
			$this->load->helper(['string','config_file']);
			$file_name = string_random(5).'_'.$_FILES['userfile']['name'];
            $file_name = str_replace(' ', '_', $file_name);
            $folder_name = 'files';

			// Upload file
			$this->load->library('upload', get_file_configuration($folder_name, $file_name));

			if(!$this->upload->do_upload()){
				$this->session->set_flashdata('errors', $this->upload->display_errors());
				redirect('perbaikan/index');
			} else {
				//$data = array('upload_data' => $this->upload->data());
				$data['lampiran'] = $file_name;
			}
		}

		$perbaikan = $this->riwayat_perbaikan_model->create_history($data);

        $repaired_asset = $this->aset_model->update_asset(['id'=> $aset[0]['id'],'kondisi'=> $this->input->post('kondisi')]);
        
        /*create notification*/
        $notification = [
			'judul' => 'Terdapat aset baru dalam proses perbaikan ',
            'deskripsi' => 'Aset dengan kode '.$repaired_asset['kode'].' dari ruangan '.
                            $repaired_asset['nama']." dalam status '".$repaired_asset['kondisi']."'",
			'tipe' => 'kerusakan',
			'user_group' => ['input_admin','kalab','admin'],
		];
		
        $this->notifikasi_model->create_notification($notification);
        
		$this->session->set_flashdata('message', 'Successfully change condition of assets.');
		redirect('perbaikan/index');
	}
	
	public function edit($id)
    {
        $history = $this->riwayat_perbaikan_model->get_history($id);
        $this->layout->template('admin')->render('perbaikan/edit', [
			'user' => $this->user,
			'subtitle' => "Perbaikan",
			'pages' => ['Perbaikan' => 'perbaikan', 'Edit' => 'perbaikan/edit/'.$id],
            'header' => "Edit history '" . $history['kode'] . "'",

            'history' => $history,
            'kondisi' => $this->acuan_aset_model->get_acuan(false, 'kondisi'),
            'created_user' => $this->ion_auth->user($history['created_by'])->row(),
			'last_updated_user' => $this->ion_auth->user($history['updated_by'])->row(),
        ]);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('kode', 'kode aset', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'tanggal masuk', 'required');
        $this->form_validation->set_rules('masalah', 'masalah', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('perbaikan/index');
		}else if ($this->input->post('tanggal_selesai')!= null && $this->input->post('tanggal_masuk') > $this->input->post('tanggal_selesai')){
            $this->session->set_flashdata('errors', "Sorry, the date of entry must be past from the end date");
            redirect('perbaikan/edit/'.$id);
        }
        
        $aset = $this->aset_model->get_assets(false,['kode'=> $this->input->post('kode')]);

		$data = [ 
            'id' => $id,
            'id_aset' => $aset[0]['id'],
            'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            'tanggal_selesai' => $this->input->post('tanggal_selesai'),
            'masalah' => $this->input->post('masalah'),
            'solusi' => $this->input->post('solusi'),
            'updated_by' => $this->user->id,
        ];
        
        if($this->input->post('keterangan') != null){
            $data['keterangan'] = $this->input->post('keterangan');
        }


        if(!empty($_FILES['userfile']['name'])){
			$this->load->helper(['string','config_file']);
			$file_name = string_random(5).'_'.$_FILES['userfile']['name'];
            $file_name = str_replace(' ', '_', $file_name);
            $folder_name = 'files';

			// Upload file
			$this->load->library('upload', get_file_configuration($folder_name, $file_name));

			if(!$this->upload->do_upload()){
				$this->session->set_flashdata('errors', $this->upload->display_errors());
				redirect('perbaikan/index');
			} else {
				//$data = array('upload_data' => $this->upload->data());
				$data['lampiran'] = $file_name;
			}
		}

		$perbaikan = $this->riwayat_perbaikan_model->update_history($data);

        $this->aset_model->update_asset(['id'=> $aset[0]['id'],'kondisi'=> $this->input->post('kondisi')]);
        
		$this->session->set_flashdata('message', 'Successfully update history.');
		redirect('perbaikan/index');

    }

    public function delete($id)
    {
        $this->riwayat_perbaikan_model->delete_history($id);
        $this->session->set_flashdata('message', 'Successfully delete repairment history.');
        redirect('perbaikan/index');
    }

    public function download_surat($id)
	{
		$this->load->helper('download');
		$file_name = $this->riwayat_perbaikan_model->get_history($id)['lampiran'];
        if($file_name == null){
			$this->session->set_flashdata('errors', "No attachment found.");
        	redirect('perbaikan/index');
		}
		$public_path = BASEPATH.'/../'.'public'.DIRECTORY_SEPARATOR;
		$download_path = $public_path.'/assets/files/'.$file_name;
		force_download($download_path, NULL);
	}
}
