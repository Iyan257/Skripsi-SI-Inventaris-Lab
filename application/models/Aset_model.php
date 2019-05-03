<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aset_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
    }

    public function get_assets($id = false, $condition=[], $order_by_category=false)
    {
        if(isset($condition['type']) || isset($condition['processor']) || isset($condition['os'])
         || isset($condition['memory']) || isset($condition['hard_drive']) || isset($condition['jumlah_port'])){

            // search by specification
            return $this->get_assets_specification($condition);
        }
        else if(isset($condition['computer_in_rooms'])){
            unset($condition['computer_in_rooms']);
            return $this->get_computer_in_rooms($condition);
        }
        else if(isset($condition['pembelian'])){
            return $this->get_assets_pembelian();    
        }
        else{
            if(isset($condition['penyusutan'])){
                // search for asset that have depreciation
                $this->db->select(['aset.id', 'aset.id_kategori', 'aset.id_kategori_khusus', 'aset.id_ruangan', 'aset.id_spesifikasi' ,'aset.kode','aset.nama_aset','aset.merek','aset.kondisi','aset.tanggal_penerimaan',
                                    'aset.umur_ekonomis','aset.nilai_aset', 'aset.nomor_kursi', 'aset.nomor_identitas' ,'aset.gambar', 'aset.keterangan', 'ruangan.nama', 'ruangan.ruangan','kategori.nama_kategori',
                                    'kategori_khusus.nama_kategori_khusus','kategori_khusus.warna_label','TIMESTAMPDIFF(year, aset.tanggal_penerimaan, NOW()) as masa_pakai',
                                    'CONVERT(aset.umur_ekonomis - TIMESTAMPDIFF(year, aset.tanggal_penerimaan, NOW()) , signed) as umur_saat_ini']);
                $this->db->having('umur_saat_ini <=',  1);
                unset($condition['penyusutan']);
            }else{
                $this->db->select(['aset.id', 'aset.id_kategori', 'aset.id_kategori_khusus', 'aset.id_ruangan', 'aset.id_spesifikasi' ,'aset.kode','aset.nama_aset','aset.merek','aset.kondisi','aset.tanggal_penerimaan',
                                    'aset.umur_ekonomis','aset.nilai_aset', 'aset.nomor_kursi', 'aset.nomor_identitas' ,'aset.gambar', 'aset.keterangan', 'ruangan.nama', 'ruangan.ruangan','kategori.nama_kategori',
                                    'kategori_khusus.nama_kategori_khusus','kategori_khusus.warna_label','TIMESTAMPDIFF(year, aset.tanggal_penerimaan, NOW()) as masa_pakai']);                                    
            }
            $this->db->where('aset.deleted_at', null);
            $this->db->where($condition);
                
            if($order_by_category){
                $this->db->order_by('kategori.nama_kategori', 'ASC');
            }
            if ($id === false) {
                $this->db->order_by('aset.id', 'DESC');
                $this->db->join('ruangan', 'aset.id_ruangan = ruangan.id', 'left');
                $this->db->join('kategori', 'aset.id_kategori = kategori.id', 'left');
                $this->db->join('kategori_khusus', 'aset.id_kategori_khusus = kategori_khusus.id', 'left');
                $query = $this->db->get('aset');
                
                return $query->result_array();
            } else {
                $this->db->join('ruangan', 'aset.id_ruangan = ruangan.id', 'left');
                $this->db->join('kategori', 'aset.id_kategori = kategori.id', 'left');
                $this->db->join('kategori_khusus', 'aset.id_kategori_khusus = kategori_khusus.id', 'left');
                $query = $this->db->get_where('aset', array('aset.id' => $id));
                return $query->row_array();
            }
        }
    }

    private function get_assets_specification($condition)
    {
        $this->db->select(['aset.id', 'aset.id_kategori', 'aset.id_kategori_khusus', 'aset.id_ruangan', 'aset.id_spesifikasi' ,'aset.kode','aset.nama_aset','aset.merek','aset.kondisi','aset.tanggal_penerimaan',
                                'aset.umur_ekonomis','aset.nilai_aset', 'aset.nomor_kursi', 'aset.nomor_identitas' ,'aset.gambar', 'aset.keterangan', 'ruangan.nama', 'ruangan.ruangan','kategori.nama_kategori',
                                'kategori_khusus.nama_kategori_khusus','kategori_khusus.warna_label' ,'TIMESTAMPDIFF(year, aset.tanggal_penerimaan, NOW()) as masa_pakai']);
        $this->db->where('aset.deleted_at', null);
        $this->db->where($condition);
        $this->db->order_by('aset.id', 'DESC');
        $this->db->join('ruangan', 'aset.id_ruangan = ruangan.id', 'left');
        $this->db->join('kategori', 'aset.id_kategori = kategori.id', 'left');
        $this->db->join('kategori_khusus', 'aset.id_kategori_khusus = kategori_khusus.id', 'left');
        $this->db->join('spesifikasi','aset.id_spesifikasi = spesifikasi.id', 'left');
        $query = $this->db->get('aset');
        
        return $query->result_array();
    }

    private function get_computer_in_rooms($condition)
    {
        $query = "SELECT distinct 
                    temp1.nama, temp1.nomor_kursi, temp1.kondisi 
                from 
                    (SELECT distinct ruangan.nama, nomor_kursi, kategori_khusus.nama_kategori_khusus, kondisi 
                    FROM `aset` inner join ruangan on aset.id_ruangan = ruangan.id 
                    inner join kategori_khusus on aset.id_kategori_khusus = kategori_khusus.id 
                    where 
                        nomor_kursi is not null AND 
                        (nama_kategori_khusus = 'komputer' or nama_kategori_khusus = 'monitor') ";
                    if(isset($condition['kondisi'])){
                        $query .= "AND kondisi = '".$condition['kondisi']."' ";
                    }else{
                        $query .= "AND kondisi = 'baik' ";
                    }
                    if(isset($condition['ruangan'])){
                        $query .= "AND ruangan.nama = '".$condition['ruangan']."' ";
                    }
                $query .=" ) as temp1 group by temp1.nama, temp1.nomor_kursi, temp1.kondisi 
                    having count(temp1.nama_kategori_khusus) = 2";
        return $this->db->query($query)->result_array();
    }

    private function get_assets_pembelian()
    {
        $this->db->select(['aset.id', 'aset.kode','aset.nama_aset','aset.tanggal_penerimaan',
                                'aset.nilai_aset', 
                                'TIMESTAMPDIFF(year, aset.tanggal_penerimaan, NOW()) as masa_pakai']);
        $this->db->where('aset.deleted_at', null);
        $this->db->where('aset.id_kategori', null);
        $this->db->order_by('aset.id', 'DESC');
        $query = $this->db->get('aset');
        
        return $query->result_array();
    }

    public function get_num_rows()
    {
        $this->db->where('deleted_at', null);
        return $this->db->get('aset')->num_rows();
    }

    public function get_num_of_computer ()
    {
        $condition = [
            'aset.nomor_identitas !=' => null,
            'kategori_khusus.nama_kategori_khusus' => 'Komputer',
        ];
        $this->db->join('kategori_khusus', 'aset.id_kategori_khusus = kategori_khusus.id');
        $this->db->join('ruangan', 'aset.id_ruangan = ruangan.id');
        $this->db->where($condition);
        $this->db->where_in('ruangan.nama',['Laboratorium 1', 'Laboratorium 2', 'Laboratorium 3', 'Laboratorium 4']);
        return $this->db->get('aset')->num_rows();
    }

    public function create_asset($data)
    {   
        $this->db_timestamp->timestamp_create($data);

        $verdict = $this->db->insert('aset', $data);
        return !$verdict ? false : $this->get_assets($this->db->insert_id());
    }

    public function update_asset($data)
    {
        if(isset($data['gambar'])){
            //remove unused image
            $this->load->helper('config_file');
            $file_name = $this->get_assets($data['id'])['gambar'];
            delete_file('aset', $file_name);
        }
        $this->db_timestamp->timestamp_update($data);

        $this->db->where('id', $data['id']);
        $verdict = $this->db->update('aset', $data);
        return !$verdict ? false : $this->get_assets($data['id']);
    }

    public function delete_asset($id)
    {
        $this->load->helper('config_file');
        $file_name = $this->get_assets($id)['gambar'];
        delete_file('aset',$file_name);
        
        $data = $this->db_timestamp->softdelete_delete();
        return $this->db->update('aset', $data, "id = $id");
    }
}
