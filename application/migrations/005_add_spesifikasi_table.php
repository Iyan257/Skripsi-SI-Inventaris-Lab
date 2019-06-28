<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_spesifikasi_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('spesifikasi', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
            'jumlah_port' => array(
                'type' => 'INT',
                'constraint' => '8',
                'null' => true,
            ),
            'processor' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
            'os1' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
            'os2' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
            'os3' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
            'memory' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
            'hard_drive' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
            'keterangan' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
        );

        $this->db_timestamp->timestamp_field($data);

        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('spesifikasi');

        // Dumping data for table 'spesifikasi'
		$data = array(
			array(
                'type' => 'HP',
                'processor' => 'i5',
                'os1' => 'Windows',
                'os2' => 'Ubuntu',
                'os3' => '',
                'memory' => '8 GB',
                'hard_drive' => '1 TB',
                'keterangan' => '-'
            ),
		);
		$this->db->insert_batch('spesifikasi', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('spesifikasi', true);
    }
}
