<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
    }

    public function get_request($id = false, $id_user = false, $like=[])
    {
        $this->db->select('permintaan.*, users.inisial, users.name');
        $this->db->like($like);
        if($id_user != false){
            $this->db->where('permintaan.id_user', $id_user);
        }
        
        if ($id === false) {
            $this->db->order_by('permintaan.id', 'DESC');
            $this->db->join('users', 'permintaan.id_user = users.id');
            $query = $this->db->get('permintaan');
            return $query->result_array();
        } else {
            $this->db->order_by('permintaan.id', 'DESC');
            $this->db->join('users', 'permintaan.id_user = users.id');
            $query = $this->db->get_where('permintaan', array('permintaan.id' => $id));
            return $query->row_array();
        }
    }

    public function get_num_rows()
    {
        return $this->db->get('permintaan')->num_rows();
    }

    public function create_request($data)
    {
        $this->db_timestamp->timestamp_create($data);

        $verdict = $this->db->insert('permintaan', $data);
        return !$verdict ? false : $this->get_request($this->db->insert_id());
    }

    public function update_request($data)
    {
        $this->db_timestamp->timestamp_update($data);

        $this->db->where('id', $data['id']);
        $verdict = $this->db->update('permintaan', $data);
        return !$verdict ? false : $this->get_request($data['id']);
    }

    public function delete_request($id)
    {
        return $this->db->delete('permintaan', "id = $id");
    }
}
