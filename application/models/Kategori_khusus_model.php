<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_khusus_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
    }

    public function get_categories($id = false, $condition=[])
    {
        $this->db->where('kategori_khusus.deleted_at', null);
        $this->db->where($condition);
        $this->db->select(['kategori_khusus.id', 'kategori_khusus.id_kategori', 'kategori_khusus.nama_kategori_khusus', 'kategori_khusus.warna_label',
                        'kategori.nama_kategori',' COUNT(id_kategori_khusus) as ct']);
        if ($id === false) {
            $this->db->order_by('kategori_khusus.nama_kategori_khusus', 'ASC');
            $this->db->join('kategori', 'kategori.id = kategori_khusus.id_kategori');
            $this->db->join('aset', 'aset.id_kategori_khusus = kategori_khusus.id', 'left');
            $this->db->group_by('kategori_khusus.id');
            $query = $this->db->get('kategori_khusus');
            return $query->result_array();
        } else {
            $this->db->join('kategori', 'kategori.id = kategori_khusus.id_kategori');
            $this->db->join('aset', 'aset.id_kategori_khusus = kategori_khusus.id','left');
            $this->db->group_by('kategori_khusus.id');
            $query = $this->db->get_where('kategori_khusus', array('kategori_khusus.id' => $id));
            return $query->row_array();
        }
    }
    public function get_num_rows()
    {
        $this->db->where('deleted_at', null);
        return $this->db->get('kategori_khusus')->num_rows();
    }

    public function create_category($data)
    {
        $this->db_timestamp->timestamp_create($data);

        $verdict = $this->db->insert('kategori_khusus', $data);
        return !$verdict ? false : $this->get_categories($this->db->insert_id());
    }

    public function update_category($data)
    {
        $this->db_timestamp->timestamp_update($data);

        $this->db->where('id', $data['id']);
        $verdict = $this->db->update('kategori_khusus', $data);
        return !$verdict ? false : $this->get_categories($data['id']);
    }

    public function delete_category($id)
    {
        $data = $this->db_timestamp->softdelete_delete();
        return $this->db->update('kategori_khusus', $data, "id = $id");
    }
}
