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
            'os' => $this->get_distinct_os(),
            'memory' => $this->get_distinct_field('memory'),
            'hard_drive' => $this->get_distinct_field('hard_drive'),
        ];
    }

    public function get_distinct_field($field){
        $temp = $this->db->distinct()
                        ->select('spesifikasi.'.$field)
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
    public function get_distinct_os($field = 'os'){
        $temp = $this->db->query("select distinct os1 as os from (select distinct os1 from spesifikasi as temp1 union (select distinct os2 from spesifikasi as temp2) union (select distinct os3 from spesifikasi as temp3)) as temp4 where os1 is not null")->result_array();
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
        return $this->db->delete('spesifikasi', "id = $id");
    }
}
