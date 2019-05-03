<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_kategori_khusus_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('kategori_khusus', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'id_kategori' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
            ),
            'nama_kategori_khusus' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ),
			'warna_label' => array(
				'type' => 'VARCHAR',
				'constraint' => '20',
				'null' => true,
			),
        );

        $this->db_timestamp->timestamp_field($data);
        $this->db_timestamp->softdelete_field($data);

        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('kategori_khusus');

        $sql="
            alter table kategori_khusus 
            add FOREIGN key (id_kategori) REFERENCES kategori(id)";
            
        $this->db->query($sql);

        // Dumping data for table 'kategori_khusus'
		$data = array(
			array(
                'id_kategori' => '1',
                'nama_kategori_khusus' => 'Router',
            ),
            array(
                'id_kategori' => '2',
                'nama_kategori' => 'Switch',
            ),
		);
		//$this->db->insert_batch('kategori_khusus', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('kategori_khusus', true);
    }
}
