<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
        // delete exp notification
        $this->delete_exp_notification_user();
        $this->delete_exp_notification();
    }

    public function get_notifications($id = false, $id_user=false, $condition=[])
    {
        if($id_user != false){
            // set exp_date notifikasi yaitu 1 minggu dari notifikasi ditampilkan
            $this->db->select(['notifikasi.*', 'notifikasi_user.id as notifikasi_user_id', 'notifikasi_user.id_user', 'notifikasi_user.exp_date']);
            $this->db->join('notifikasi_user', 'notifikasi.id = notifikasi_user.id_notifikasi');
            
            $this->db->where('notifikasi_user.id_user', $id_user);
            $query = $this->db->get('notifikasi');
            $notifications = $query->result_array();
            $d = strtotime("+1 weeks");
            $exp = date("Y-m-d", $d);
            foreach($notifications as $notif){
                if($notif['exp_date'] == null || $notif['exp_date'] == "0000-00-00"){
                    $this->update_notification_user(['id' => $notif['notifikasi_user_id'], 'exp_date' => $exp]);
                }
            }
        }
        // mendapatkan notifikasi untuk pengguna dengan id yang sesuai
        $this->db->select(['notifikasi.*', 'notifikasi_user.id as notifikasi_user_id', 'notifikasi_user.id_user', 'notifikasi_user.exp_date']);
        $this->db->join('notifikasi_user', 'notifikasi.id = notifikasi_user.id_notifikasi');
        $this->db->where($condition);
        if($id_user != false){
            $this->db->where('notifikasi_user.id_user', $id_user);
        }
        if ($id === false) {
            $this->db->order_by('notifikasi.updated_at', 'DESC');
            $query = $this->db->get('notifikasi');
            return $query->result_array();
        } else {
            $query = $this->db->get_where('notifikasi', array('notifikasi.id' => $id));
            return $query->row_array();
        }
    }

    public function get_notifications_by_group($user_group, $condition){
        $this->db->select('notifikasi.*, groups.name, notifikasi_user.id_user');
        $this->db->where('groups.name', $user_group);
        $this->db->where($condition);
        $this->db->join('notifikasi_user', 'notifikasi.id = notifikasi_user.id_notifikasi');
        $this->db->join('users_groups', 'notifikasi_user.id_user = users_groups.user_id');
        $this->db->join('groups', 'users_groups.group_id = groups.id');
        $this->db->order_by('notifikasi.id', 'DESC');
        $query = $this->db->get('notifikasi');
        return $query->result_array();
    }

    public function get_num_rows()
    {
        return $this->db->get('notifikasi')->num_rows();
    }

    public function create_notification ($data)
    {
        $notification =[
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'],
            'tipe' => $data['tipe'],
        ];
        $this->db_timestamp->timestamp_create($notification);
        $verdict = $this->db->insert('notifikasi', $notification);

        if($verdict){
            // insert successfull
            $id_notifikasi = $this->db->insert_id();
            $received_user = [];
            foreach($data['user_group'] as $ug){
                $group = $ug;
                
                $users = $this->ion_auth->users()->result();
                foreach ($users as $k => $user) {
                    $user_groups = $this->ion_auth->get_users_groups($user->id)->result();
                    $user->groups = array_map(function ($x) use ($user_groups){
                        return $user_groups[$x]->name;
                    }, range(0, count($user_groups) - 1));
        
                    if(in_array($group, $user->groups) && !in_array($user->id, $received_user)){
                        $user_notification = [
                            'id_user' => $user->id,
                            'id_notifikasi' => $id_notifikasi,
                        ];
                        array_push($received_user, $user->id);
                        $this->db->insert('notifikasi_user', $user_notification);
                    }
                }
            }
        }
        return !$verdict ? false : true;
    }

    public function update_notification($data)
    {
        $this->db_timestamp->timestamp_update($data);

        $this->db->where('notifikasi.id', $data['id']);
        $verdict = $this->db->update('notifikasi', $data);
        return !$verdict ? false : $this->get_notifications($data['id']);
    }

    public function update_notification_user($data)
    {
        $this->db->where('notifikasi_user.id', $data['id']);
        $verdict = $this->db->update('notifikasi_user', $data);
        return !$verdict ? false : true;
    }

    public function delete_notification($id)
    {
        return $this->db->delete('notifikasi', "id = $id");
    }

    public function delete_notification_user($id_notifikasi){
        $this->db->where('id_notifikasi', $id_notifikasi);
        return $this->db->delete('notifikasi_user');
    }

    public function delete_exp_notification(){
        $this->db->select(['notifikasi.id', 'notifikasi_user.id as notifikasi_user_id']);
        $this->db->join('notifikasi_user', 'notifikasi.id = notifikasi_user.id_notifikasi','left');
        $this->db->where('notifikasi_user.id', null);
        $query = $this->db->get('notifikasi');
        $temp = $query->result_array();
        foreach($temp as $notif){
            $this->db->delete('notifikasi', array('id' => $notif['id']));
        }
        return true;
    }

    public function delete_exp_notification_user(){
        $this->db->where('exp_date <', date("Y-m-d"));
        return $this->db->delete('notifikasi_user');
    }
}
