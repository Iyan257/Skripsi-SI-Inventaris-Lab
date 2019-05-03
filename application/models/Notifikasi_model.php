<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('db_timestamp');
    }

    public function get_notifications($id = false, $id_user=false, $condition=[])
    {
        $this->delete_exp_notification();
        $this->db->where('notifikasi.deleted_at', null);
        if($id_user != false){
            $this->db->where('notifikasi_user.id_user', $id_user);
        }
        $this->db->where($condition);
        $this->db->join('notifikasi_user', 'notifikasi.id = notifikasi_user.id_notifikasi');
        if ($id === false) {
            $this->db->order_by('notifikasi.id', 'DESC');
            $query = $this->db->get('notifikasi');
            $notifications = $query->result_array();
            $d = strtotime("+1 weeks");
            $exp = date("Y-m-d", $d);
            foreach($notifications as $notif){
                if($notif['exp_date'] == null || $notif['exp_date'] == "0000-00-00"){
                    $this->update_notification(['id' => $notif['id'], 'exp_date' => $exp]);
                }
            }
            return $notifications;
        } else {
            $query = $this->db->get_where('notifikasi', array('notifikasi.id' => $id));
            return $query->row_array();
        }
    }

    public function get_notifications_by_group($user_group, $condition){
        $this->db->select('notifikasi.*, groups.name, notifikasi_user.id_user');
        $this->db->where('notifikasi.deleted_at', null);
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
        $this->db->where('deleted_at', null);
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
            $group = $data['user_group'];
            
            $users = $this->ion_auth->users()->result();
            foreach ($users as $k => $user) {
                $user_groups = $this->ion_auth->get_users_groups($user->id)->result();
                $user->groups = array_map(function ($x) use ($user_groups){
                    return $user_groups[$x]->name;
                }, range(0, count($user_groups) - 1));
    
                if(in_array($group, $user->groups)){
                    $user_notification = [
                        'id_user' => $user->id,
                        'id_notifikasi' => $id_notifikasi,
                    ];
                    $this->db_timestamp->timestamp_create($user_notification);
                    $this->db->insert('notifikasi_user', $user_notification);
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

    public function delete_notification($id)
    {
        $data = $this->db_timestamp->softdelete_delete();
        return $this->db->update('notifikasi', $data, "id = $id");
    }

    public function delete_notification_user($id_notifikasi){
        $data = $this->db_timestamp->softdelete_delete();
        $this->db->set($data);
        $this->db->where('id_notifikasi', $id_notifikasi);
        return $this->db->update('notifikasi_user');
    }

    public function delete_exp_notification(){
        $data = $this->db_timestamp->softdelete_delete();
        $this->db->set($data);
        $this->db->where('exp_date <', date("Y-m-d"));
        return $this->db->update('notifikasi');
    }
}
