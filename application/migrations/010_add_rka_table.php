<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_rka_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('rka', true);
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
            'total_anggaran' => array(
                'type' => 'INT',
                'constraint' => '8',
                'null' => true,
            ),
            'total_terealisasi' => array(
                'type' => 'INT',
                'constraint' => '8',
                'null' => true,
            ),
        );

        $this->db_timestamp->timestamp_field($data);
        $this->db_timestamp->softdelete_field($data);

        
        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('rka');
    }

    public function down()
    {
        $this->dbforge->drop_table('rka', true);
    }
}
