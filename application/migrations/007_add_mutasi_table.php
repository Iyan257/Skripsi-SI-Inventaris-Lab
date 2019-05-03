<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_mutasi_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('mutasi', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'id_ruangan_asal' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
            ),
            'id_ruangan_tujuan' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
            ),
            'keterangan' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ),
        );

        $this->db_timestamp->timestamp_field($data);
        $this->db_timestamp->softdelete_field($data);

        
        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('mutasi');

        $sql="
            alter table mutasi 
            add FOREIGN key (id_ruangan_asal) REFERENCES ruangan(id), 
            add FOREIGN key (id_ruangan_tujuan) REFERENCES ruangan(id)";
            
        $this->db->query($sql);
		
		$this->db->query('ALTER TABLE mutasi ADD updated_by MEDIUMINT(8) unsigned AFTER deleted_at');
        $this->db->query('ALTER TABLE mutasi ADD created_by MEDIUMINT(8) unsigned AFTER deleted_at');
        $this->db->query('ALTER TABLE mutasi ADD FOREIGN key (created_by) REFERENCES users(id),
        ADD FOREIGN key (updated_by) REFERENCES users(id);');

        // Dumping data for table 'mutasi'
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
		//$this->db->insert_batch('mutasi', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('mutasi', true);
    }
}
