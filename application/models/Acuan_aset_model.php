<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Acuan_aset_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_acuan($id = false, $jenis_acuan='')
    {
        if($jenis_acuan != ''){
            $this->db->where('jenis_acuan', $jenis_acuan);
        }
        if ($id === false) {
            $this->db->order_by('acuan_aset.id', 'ASC');
            $query = $this->db->get('acuan_aset');
            return $query->result_array();
        } else {
            $query = $this->db->get_where('acuan_aset', array('id' => $id));
            return $query->row_array();
        }
    }
}
