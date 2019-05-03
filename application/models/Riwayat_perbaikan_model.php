<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat_perbaikan_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
    }

    public function get_history($id = false, $condition=[])
    {
        $this->db->select(['riwayat_perbaikan.id as id','riwayat_perbaikan.tanggal_masuk',
                    'riwayat_perbaikan.tanggal_selesai', 'riwayat_perbaikan.masalah', 
                    'riwayat_perbaikan.solusi', 'riwayat_perbaikan.keterangan', 'riwayat_perbaikan.lampiran' , 
                    'riwayat_perbaikan.created_by', 'riwayat_perbaikan.updated_by','aset.kode', 'aset.kondisi']);
        $this->db->where('riwayat_perbaikan.deleted_at', null);
        $this->db->where($condition);
        if ($id === false) {
            $this->db->join('aset', 'riwayat_perbaikan.id_aset = aset.id');
            $this->db->order_by('riwayat_perbaikan.id', 'DESC');
            $query = $this->db->get('riwayat_perbaikan');
            return $query->result_array();
        } else {
            $this->db->join('aset', 'riwayat_perbaikan.id_aset = aset.id');
            $this->db->order_by('riwayat_perbaikan.id', 'DESC');
            $query = $this->db->get_where('riwayat_perbaikan', array('riwayat_perbaikan.id' => $id));
            return $query->row_array();
        }
    }
    public function get_num_rows()
    {
        $this->db->where('deleted_at', null);
        return $this->db->get('riwayat_perbaikan')->num_rows();
    }

    public function create_history($data)
    {
        $this->db_timestamp->timestamp_create($data);

        $verdict = $this->db->insert('riwayat_perbaikan', $data);
        return !$verdict ? false : $this->get_history($this->db->insert_id());
    }

    public function update_history($data)
    {
        if(isset($data['lampiran'])){
            //remove unused image
            $this->load->helper('config_file');
            $file_name = $this->get_history($data['id'])['lampiran'];
            delete_file('files', $file_name, true);
        }
        $this->db_timestamp->timestamp_update($data);

        $this->db->where('id', $data['id']);
        $verdict = $this->db->update('riwayat_perbaikan', $data);
        return !$verdict ? false : $this->get_history($data['id']);
    }

    public function delete_history($id)
    {
        $this->load->helper('config_file');
        $file_name = $this->get_history($id)['lampiran'];
        delete_file('files', $file_name, true);

        $data = $this->db_timestamp->softdelete_delete();
        return $this->db->update('riwayat_perbaikan', $data, "id = $id");
    }
}
