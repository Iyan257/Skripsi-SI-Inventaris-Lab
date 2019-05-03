<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library(['session', 'form_validation','layout']);
		$this->load->model(['riwayat_perbaikan_model', 'notifikasi_model','aset_model']);

		// check if user have some notifications
		if($this->ion_auth->in_group("kalab"))$this->check_asset();
		$this->check_pembelian();
	}
	public function index()
	{	
        $data = [
			'subtitle' => 'Dashboard',
			'user' => $this->user,
			'groups' => $this->groups,
			
			'history' => $this->riwayat_perbaikan_model->get_history(false, ['tanggal_selesai' => null]),
			'notifications' => $this->notifikasi_model->get_notifications(false, $this->user->id),
		];
        $this->layout->template('admin')->render('index', $data);
	}
	
	private function check_asset(){
		$condition = ['penyusutan' => 'ya'];
		$assets = $this->aset_model->get_assets(false, $condition);
		if(!empty($assets)){
			$data = [
				'judul' => 'Terdapat aset dengan masa pakai yang mendekati atau lebih dari umur ekonomisnya',
				'deskripsi' => 'Terdapat '.count($assets).' aset yang mungkin perlu dianggarkan untuk tahun depan.',
				'tipe' => 'penyusutan',
			];
			// check jika notifikasi sudah dibuat sebelumnya
			$notification = $this->notifikasi_model->get_notifications(false, $this->user->id, ['tipe'=>'penyusutan']);
			if(empty($notification)){
				// buat notifikasi
				$data['user_group'] = 'kalab';
				$this->notifikasi_model->create_notification($data);
			}
			else{
				// update notifikasi
				$data['id'] = $notification[0]['id'];
				$this->notifikasi_model->update_notification($data);
			}
		}else{
			$notification = $this->notifikasi_model->get_notifications_by_group('kalab', ['tipe'=>'penyusutan']);
			foreach($notification as $n){
				$this->notifikasi_model->delete_notification_user($n['id']);
				$this->notifikasi_model->delete_notification($n['id']);
			}
		}
	}

	private function check_pembelian(){
		$assets = $this->aset_model->get_assets(false, ['aset.id_kategori'=>null]);
		$notification = $this->notifikasi_model->get_notifications_by_group('input_admin', ['tipe'=>'pembelian']);
		if(empty($assets)){
			foreach($notification as $n){
				$this->notifikasi_model->delete_notification_user($n['id']);
				$this->notifikasi_model->delete_notification($n['id']);
			}
		}
	}
}
