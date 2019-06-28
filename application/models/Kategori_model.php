<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
    }

    public function get_categories($id = false)
    {
        if ($id === false) {
            $this->db->order_by('kategori.nama_kategori', 'ASC');
            $query = $this->db->get('kategori');
            return $query->result_array();
        } else {
            $query = $this->db->get_where('kategori', array('id' => $id));
            return $query->row_array();
        }
    }
    public function get_num_rows()
    {
        return $this->db->get('kategori')->num_rows();
    }

    public function create_category($data)
    {
        $this->db_timestamp->timestamp_create($data);

        $verdict = $this->db->insert('kategori', $data);
        return !$verdict ? false : $this->get_categories($this->db->insert_id());
    }

    public function update_category($data)
    {
        $this->db_timestamp->timestamp_update($data);

        $this->db->where('id', $data['id']);
        $verdict = $this->db->update('kategori', $data);
        return !$verdict ? false : $this->get_categories($data['id']);
    }

    public function delete_category($id)
    {
        return $this->db->delete('kategori', "id = $id");
    }
}
