<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_notifikasi_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('notifikasi', true);
        /**
         * id
         * judul
         * deskripsi
         * tipe
         * expired date
         */
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'judul' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'deskripsi' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'tipe' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'exp_date' => array(
                'type' => 'DATE',
                'null' => true,
            ),
        );
        
        $this->db_timestamp->timestamp_field($data);
        $this->db_timestamp->softdelete_field($data);

        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('notifikasi');
    }

    public function down()
    {
        $this->dbforge->drop_table('notifikasi', true);
    }
}
