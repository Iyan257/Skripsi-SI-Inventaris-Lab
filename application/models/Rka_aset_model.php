<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rka_aset_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
    }

    public function get_rka_aset($id = false, $id_rka = false)
    {
        $this->db->where('deleted_at', null);
        if($id_rka){
            $this->db->where('id_rka', $id_rka);
        }
        if ($id === false) {
            $this->db->order_by('rka_aset.id', 'ASC');
            $query = $this->db->get('rka_aset');
            return $query->result_array();
        } else {
            $this->db->order_by('rka_aset.id', 'ASC');
            $query = $this->db->get_where('rka_aset', array('rka_aset.id' => $id));
            return $query->row_array();
        }
    }
    public function get_num_rows()
    {
        $this->db->where('deleted_at', null);
        return $this->db->get('rka_aset')->num_rows();
    }

    public function create_rka_aset($data)
    {
        $this->db_timestamp->timestamp_create($data);

        $verdict = $this->db->insert('rka_aset', $data);
        return !$verdict ? false : $this->get_rka_aset($this->db->insert_id());
    }

    public function update_rka_aset($data)
    {
        $this->db_timestamp->timestamp_update($data);
        
        $this->db->where('id', $data['id']);
        $verdict = $this->db->update('rka_aset', $data);
        return !$verdict ? false : $this->get_rka_aset($data['id']);
    }

    public function delete_rka_aset($id_rka = false, $id='')
    {
        $data = $this->db_timestamp->softdelete_delete();
        if($id_rka){
            $this->db->where(['id_rka'=>$id_rka]);
            return $this->db->update('rka_aset', $data);
        }
        return $this->db->update('rka_aset', $data, "id = $id");;
    }
}
