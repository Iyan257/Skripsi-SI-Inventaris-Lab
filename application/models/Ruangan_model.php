<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruangan_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
    }

    public function get_rooms($id = false)
    {
        if ($id === false) {
            $this->db->order_by('ruangan.id', 'DESC');
            $query = $this->db->get('ruangan');
            return $query->result_array();
        } else {
            $query = $this->db->get_where('ruangan', array('id' => $id));
            return $query->row_array();
        }
    }
    public function get_num_rows()
    {
        return $this->db->get('ruangan')->num_rows();
    }

    public function create_room($data)
    {
        $this->db_timestamp->timestamp_create($data);

        $verdict = $this->db->insert('ruangan', $data);
        return !$verdict ? false : $this->get_rooms($this->db->insert_id());
    }

    public function update_room($data)
    {
        if(isset($data['gambar'])){
            //remove unused image
            $this->load->helper('config_file');
            $file_name = $this->get_rooms($data['id'])['gambar'];
            delete_file('ruangan', $file_name);
        }
        $this->db_timestamp->timestamp_update($data);

        $this->db->where('id', $data['id']);
        $verdict = $this->db->update('ruangan', $data);
        return !$verdict ? false : $this->get_rooms($data['id']);
    }

    public function delete_room($id)
    {
        $this->load->helper('config_file');
        $file_name = $this->get_rooms($id)['gambar'];
        delete_file('ruangan', $file_name);

        return $this->db->delete('ruangan', "id = $id");
    }
}
