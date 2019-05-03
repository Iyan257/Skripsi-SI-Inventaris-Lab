<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_opname_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function insert_aset($data)
    {
        $verdict = $this->db->insert('stock_opname', $data);
        return $verdict;
    }

    public function get_status(){
        $query = $this->db->get('status_so');
        return array_values($query->row_array())[0];
    }

    public function set_status($status){
        //0 = false, 1 = true
        $query = $this->db->update('status_so',['stock_opname' => $status]);
        return $query;
    }

    public function get_all_assets(){
        $this->db->select(['aset.tanggal_penerimaan', 'ruangan.nama', 'ruangan.ruangan','kategori.nama_kategori',
        'kategori_khusus.nama_kategori_khusus', 'aset.kode','aset.nama_aset','aset.merek','aset.kondisi']);
        $this->db->where('aset.deleted_at', null);
        $this->db->order_by('kategori_khusus.nama_kategori_khusus', 'DESC');
        $this->db->order_by('aset.id', 'DESC');
        $this->db->join('stock_opname', 'aset.kode = stock_opname.kode');
        $this->db->join('ruangan', 'aset.id_ruangan = ruangan.id', 'left');
        $this->db->join('kategori', 'aset.id_kategori = kategori.id', 'left');
        $this->db->join('kategori_khusus', 'aset.id_kategori_khusus = kategori_khusus.id', 'left');
        $query = $this->db->get('aset');
        return $query->result_array();
    }

    public function get_unmark_assets()
    {
        $this->db->select(['aset.tanggal_penerimaan', 'ruangan.nama', 'ruangan.ruangan','kategori.nama_kategori',
        'kategori_khusus.nama_kategori_khusus', 'aset.kode','aset.nama_aset','aset.merek','aset.kondisi']);
        $this->db->where('aset.deleted_at', null);
        $this->db->where('stock_opname.kode',null);
        $this->db->order_by('kategori_khusus.nama_kategori_khusus', 'DESC');
        $this->db->order_by('aset.id', 'DESC');
        $this->db->join('stock_opname', 'aset.kode = stock_opname.kode','left');
        $this->db->join('ruangan', 'aset.id_ruangan = ruangan.id', 'left');
        $this->db->join('kategori', 'aset.id_kategori = kategori.id', 'left');
        $this->db->join('kategori_khusus', 'aset.id_kategori_khusus = kategori_khusus.id', 'left');
        $query = $this->db->get('aset');
        return $query->result_array();
    }

    public function delete_all()
    {
        return $this->db->empty_table('stock_opname');
    }

    public function check_last_so(){
        $query = $this->db->query('SELECT * FROM stock_opname');
        return ($query->num_rows() > 0);
    }
}
