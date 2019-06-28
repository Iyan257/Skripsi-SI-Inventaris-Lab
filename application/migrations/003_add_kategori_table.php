<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_kategori_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('kategori', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'nama_kategori' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        );

        $this->db_timestamp->timestamp_field($data);

        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('kategori');

        // Dumping data for table 'kategori'
		$data = array(
			array(
                'nama_kategori' => 'Jaringan',
            ),
            array(
                'nama_kategori' => 'Non-Jaringan',
            ),
            array(
                'nama_kategori' => 'Perlengkapan',
            ),
            array(
                'nama_kategori' => 'Peralatan',
            ),
		);
		$this->db->insert_batch('kategori', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('kategori', true);
    }
}
