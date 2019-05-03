<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_mutasi_aset_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('mutasi_aset', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'id_mutasi' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
            ),
            'id_aset' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
            ),
        );
        
        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('mutasi_aset');

        $sql="
            alter table mutasi_aset 
            add FOREIGN key (id_mutasi) REFERENCES mutasi(id),
            add FOREIGN key (id_aset) REFERENCES aset(id)";
            
        $this->db->query($sql);

        // Dumping data for table 'mutasi_aset'
		$data = array(
			array(
                'merek' => 'HP',
                'processor' => 'i5',
                'os' => 'DOS',
                'memory' => '8 GB',
                'hard_drive' => '1 TB',
                'keterangan' => '-'
            ),
		);
		//$this->db->insert_batch('mutasi_aset', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('mutasi_aset', true);
    }
}
