<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rka_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
    }

    public function get_history($id = false)
    {
        $this->db->where('deleted_at', null);
        if ($id === false) {
            $this->db->order_by('rka.id', 'DESC');
            $query = $this->db->get('rka');
            return $query->result_array();
        } else {
            $this->db->order_by('rka.id', 'DESC');
            $query = $this->db->get_where('rka', array('rka.id' => $id));
            return $query->row_array();
        }
    }

    public function get_num_rows()
    {
        $this->db->where('deleted_at', null);
        return $this->db->get('rka')->num_rows();
    }

    public function create_history($data)
    {
        $this->db_timestamp->timestamp_create($data);

        $verdict = $this->db->insert('rka', $data);
        return !$verdict ? false : $this->get_history($this->db->insert_id());
    }

    public function update_history($data)
    {
        $this->db_timestamp->timestamp_update($data);

        $this->db->where('id', $data['id']);
        $verdict = $this->db->update('rka', $data);
        return !$verdict ? false : $this->get_history($data['id']);
    }

    public function delete_history($id)
    {
        $data = $this->db_timestamp->softdelete_delete();
        return $this->db->update('rka', $data, "id = $id");
    }
}
