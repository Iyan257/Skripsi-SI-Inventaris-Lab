<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mutasi_aset_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
    }

    public function get_mutasi_aset($id = false)
    {
        if ($id === false) {
            $this->db->order_by('mutasi_aset.id', 'DESC');
            $query = $this->db->get('mutasi_aset');
            return $query->result_array();
        } else {
            $this->db->order_by('mutasi_aset.id', 'DESC');
            $query = $this->db->get_where('mutasi_aset', array('mutasi_aset.id' => $id));
            return $query->row_array();
        }
    }
    public function get_num_rows()
    {
        return $this->db->get('mutasi_aset')->num_rows();
    }

    public function create_mutasi_aset($data)
    {
        $verdict = $this->db->insert('mutasi_aset', $data);
        return !$verdict ? false : $this->get_mutasi_aset($this->db->insert_id());
    }

    public function update_mutasi_aset($data)
    {
        $this->db->where('id', $data['id']);
        $verdict = $this->db->update('mutasi_aset', $data);
        return !$verdict ? false : $this->get_mutasi_aset($data['id']);
    }

    public function delete_mutasi_aset($id_mutasi = false, $id='')
    {
        if($id_mutasi){
            $this->db->where(['id_mutasi'=>$id_mutasi]);
            return $this->db->delete('mutasi_aset');
        }
        return $this->db->delete('mutasi_aset',['id'=>$id]);
    }
}
