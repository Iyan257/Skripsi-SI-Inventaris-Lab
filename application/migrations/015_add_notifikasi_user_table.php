<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_notifikasi_user_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('notifikasi_user', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'id_user' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => true,
            ),
            'id_notifikasi' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
            ),
        );
        
        $this->db_timestamp->timestamp_field($data);
        $this->db_timestamp->softdelete_field($data);

        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('notifikasi_user');

        $sql="
        alter table notifikasi_user
        add FOREIGN key (id_user) REFERENCES users(id) ";
        
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('notifikasi_user', true);
    }
}
