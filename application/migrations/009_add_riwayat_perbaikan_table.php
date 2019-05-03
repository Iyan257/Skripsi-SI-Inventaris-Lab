<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_riwayat_perbaikan_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('riwayat_perbaikan', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'id_aset' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
            ),
            'tanggal_masuk' => array(
                'type' => 'DATE',
                'null' => true,
            ),
            'tanggal_selesai' => array(
                'type' => 'DATE',
                'null' => true
            ),
            'masalah' => array(
                'type' => 'TEXT',
                'null' => true,
                'default' => null,
            ),
            'solusi' => array(
                'type' => 'TEXT',
                'null' => true,
                'default' => null,
            ),
			'keterangan' => array(
				'type' => 'TEXT',
                'null' => true,
                'default' => null,
			),
			'lampiran' => array(
				'type' => 'VARCHAR',
                'constraint' => '255',
			),
        );

        $this->db_timestamp->timestamp_field($data);
        $this->db_timestamp->softdelete_field($data);

        
        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('riwayat_perbaikan');

        $sql="
            alter table riwayat_perbaikan 
            add FOREIGN key (id_aset) REFERENCES aset(id)";
            
        $this->db->query($sql);
		
		$this->db->query('ALTER TABLE riwayat_perbaikan ADD updated_by MEDIUMINT(8) unsigned AFTER deleted_at');
        $this->db->query('ALTER TABLE riwayat_perbaikan ADD created_by MEDIUMINT(8) unsigned AFTER deleted_at');
        $this->db->query('ALTER TABLE riwayat_perbaikan ADD FOREIGN key (created_by) REFERENCES users(id),
        ADD FOREIGN key (updated_by) REFERENCES users(id);');

        // Dumping data for table 'riwayat_perbaikan'
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
		//$this->db->insert_batch('riwayat_perbaikan', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('riwayat_perbaikan', true);
    }
}
