<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spesifikasi_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
    }

    public function get_specification($id = false, $condition=[])
    {
        $this->db->where('deleted_at', null);
        $this->db->where($condition);
        if ($id === false) {
            $this->db->order_by('spesifikasi.id', 'DESC');
            $query = $this->db->get('spesifikasi');
            return $query->result_array();
        } else {
            $query = $this->db->get_where('spesifikasi', array('id' => $id));
            return $query->row_array();
        }
    }
    public function get_all_specification(){
        return [
            'type' => $this->get_distinct_field('type'), 
            'jumlah_port' => $this->get_distinct_field('jumlah_port'),
            'processor' => $this->get_distinct_field('processor'),
            'os' => $this->get_distinct_field('os'),
            'memory' => $this->get_distinct_field('memory'),
            'hard_drive' => $this->get_distinct_field('hard_drive'),
        ];
    }

    public function get_distinct_field($field){
        $temp = $this->db->distinct()
                        ->select('spesifikasi.'.$field)
                        ->where('deleted_at',null)
                        ->where('spesifikasi.'.$field.'!=' ,null)
                        ->get('spesifikasi')->result_array();
        $res = [];
        if(empty($temp) == false){
            $res = array_map(function ($x) use ($temp, $field){
                    return $temp[$x][$field];
                }, range(0, count($temp) - 1));
        }
        return $res;
    }
    public function get_num_rows()
    {
        $this->db->where('deleted_at', null);
        return $this->db->get('spesifikasi')->num_rows();
    }

    public function create_specification($data)
    {
        $this->db_timestamp->timestamp_create($data);

        $verdict = $this->db->insert('spesifikasi', $data);
        return !$verdict ? false : $this->get_specification($this->db->insert_id());
    }

    public function update_specification($data)
    {
        $this->db_timestamp->timestamp_update($data);

        $this->db->where('id', $data['id']);
        $verdict = $this->db->update('spesifikasi', $data);
        return !$verdict ? false : $this->get_specification($data['id']);
    }

    public function delete_specification($id)
    {
        $data = $this->db_timestamp->softdelete_delete();
        return $this->db->update('spesifikasi', $data, "id = $id");
    }
}
