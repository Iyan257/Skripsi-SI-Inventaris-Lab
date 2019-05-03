<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mutasi_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
    }

    public function get_history($id = false)
    {
        $this->db->select(['mutasi.id as id','mutasi.created_at as tanggal_mutasi',
        'mutasi.id_ruangan_asal', 'mutasi.id_ruangan_tujuan', 'mutasi.keterangan',
        'ruangan.nama as ruangan_asal', 'ruangan_2.nama as ruangan_tujuan',
        'mutasi.created_by', 'mutasi.updated_by']);
        $this->db->where('mutasi.deleted_at', null);
        if ($id === false) {
            $this->db->join('ruangan', 'mutasi.id_ruangan_asal = ruangan.id');
            $this->db->join('ruangan as ruangan_2', 'mutasi.id_ruangan_tujuan = ruangan_2.id');
            $this->db->order_by('mutasi.id', 'DESC');
            $query = $this->db->get('mutasi');
            return $query->result_array();
        } else {
            $this->db->join('ruangan', 'mutasi.id_ruangan_asal = ruangan.id');
            $this->db->join('ruangan as ruangan_2', 'mutasi.id_ruangan_tujuan = ruangan_2.id');
            $this->db->order_by('mutasi.id', 'DESC');
            $query = $this->db->get_where('mutasi', array('mutasi.id' => $id));
            return $query->row_array();
        }
    }

    public function get_assets($id_history)
    {
        $this->db->select(['aset.id','aset.kode','aset.nama_aset','aset.merek','aset.kondisi','aset.tanggal_penerimaan',
                            'aset.umur_ekonomis','aset.nilai_aset','aset.gambar','ruangan.nama', 'ruangan.ruangan','kategori.nama_kategori',
                            'TIMESTAMPDIFF(year, aset.tanggal_penerimaan, NOW()) as masa_pakai']);
        $this->db->where('aset.deleted_at', null);
        $this->db->where('mutasi_aset.id_mutasi', $id_history);
        $this->db->join('ruangan', 'aset.id_ruangan = ruangan.id');
        $this->db->join('kategori', 'aset.id_kategori = kategori.id');
        $this->db->join('mutasi_aset', 'aset.id = mutasi_aset.id_aset');
        $query = $this->db->get('aset');
            
        return $query->result_array();
    }

    public function get_num_rows()
    {
        $this->db->where('deleted_at', null);
        return $this->db->get('mutasi')->num_rows();
    }

    public function create_history($data)
    {
        $this->db_timestamp->timestamp_create($data);

        $verdict = $this->db->insert('mutasi', $data);
        return !$verdict ? false : $this->get_history($this->db->insert_id());
    }

    public function update_history($data)
    {
        $this->db_timestamp->timestamp_update($data);

        $this->db->where('id', $data['id']);
        $verdict = $this->db->update('mutasi', $data);
        return !$verdict ? false : $this->get_history($data['id']);
    }

    public function delete_history($id)
    {
        $data = $this->db_timestamp->softdelete_delete();
        return $this->db->update('mutasi', $data, "id = $id");
    }
}
