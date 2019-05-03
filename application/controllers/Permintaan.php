<?php defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['permintaan_model', 'notifikasi_model']);
    }

    public function index()
    {
        $data = [
            'subtitle' => 'Permintaan',
            'header' => 'Permintaan',
            'user' => $this->user,
            'request' => $this->permintaan_model->get_request(false, $this->user->id),
        ];

        $this->layout->template('admin')->render('permintaan/index', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('rencana_tahun', 'tahun pembelian', 'required');
        $this->form_validation->set_rules('judul', 'permintaan', 'required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('permintaan/index');
		}
		
		$data = array( 
			'id_user' => $this->user->id,
			'rencana_tahun' => $this->input->post('rencana_tahun'),
			'judul' => $this->input->post('judul'),
			'deskripsi' => $this->input->post('deskripsi'),
        );
        
        $permintaan = $this->permintaan_model->create_request($data);
        
        $notification = [
			'judul' => 'Terdapat permintaan barang baru untuk tahun '.$data['rencana_tahun'],
			'deskripsi' => "User '".$this->user->inisial."' mengirimi Anda satu buah permintaan pembelian baru",
			'tipe' => 'pembelian',
			'user_group' => 'kalab',
		];
		
		$this->notifikasi_model->create_notification($notification);

		$this->session->set_flashdata('message', 'Successfully send a request.');
		redirect('permintaan/index');
    }

    public function delete($id)
    {
        $this->permintaan_model->delete_request($id);
        $this->session->set_flashdata('message', 'Successfully delete request history.');
        if(in_array("kalab", $this->groups)){
            redirect('kalab/rka/index');
        }else{
            redirect('permintaan/index');
        }
    }

    public function mark_read($id)
    {
        $data = [
            'id' => $id,
            'dibaca' => '1',
        ];
        $this->permintaan_model->update_request($data);
        $this->session->set_flashdata('message', 'Successfully mark request history as read.');
        redirect('kalab/rka/index');
    }
}
