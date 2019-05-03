<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_ruangan_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('ruangan', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'ruangan' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'gambar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
        );

        $this->db_timestamp->timestamp_field($data);
        $this->db_timestamp->softdelete_field($data);

        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('ruangan');

        // Dumping data for table 'ruangan'
		$data = array(
			array(
                'nama' => 'Laboratorium 1',
                'ruangan' => '0918',
            ),
            array(
                'nama' => 'Laboratorium 2',
                'ruangan' => '0917',
            ),
            array(
                'nama' => 'Laboratorium 3',
                'ruangan' => '0916',
            ),
            array(
                'nama' => 'Laboratorium 4',
                'ruangan' => '0915',
			),
		);
		$this->db->insert_batch('ruangan', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('ruangan', true);
    }
}
