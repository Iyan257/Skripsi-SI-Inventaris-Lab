<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rka_aset_temp_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_items($id = false, $condition=[])
    {
        $this->db->where($condition);
        if ($id === false) {
            $this->db->order_by('rka_aset_temp.id', 'ASC');
            $query = $this->db->get('rka_aset_temp');
            return $query->result_array();
        } else {
            $query = $this->db->get_where('rka_aset_temp', array('rka_aset_temp.id' => $id));
            return $query->row_array();
        }
    }
    public function get_num_rows()
    {
        return $this->db->get('rka_aset_temp')->num_rows();
    }

    public function get_sum_biaya($id_user){
        $this->db->select('SUM(perkiraan_biaya) as sum_biaya, SUM(total_terealisasi) as sum_terealisasi');
        $this->db->where('id_user', $id_user);
        $this->db->where('id_aksi', null);
        $this->db->or_where('id_aksi !=', '3');
        $query = $this->db->get('rka_aset_temp');
        return $query->row_array();
    }

    public function create_item($data)
    {
        $verdict = $this->db->insert('rka_aset_temp', $data);
        return !$verdict ? false : $this->get_items($this->db->insert_id());
    }

    public function update_item($data)
    {
        $this->db->where('id', $data['id']);
        $verdict = $this->db->update('rka_aset_temp', $data);
        return !$verdict ? false : $this->get_items($data['id']);
    }

    public function delete_item($id_user = false, $id='')
    {
        if($id_user != false){
            $this->db->where(['id_user'=>$id_user]);
            return $this->db->delete('rka_aset_temp');
        }
        return $this->db->delete('rka_aset_temp', "id = $id");
    }
}
