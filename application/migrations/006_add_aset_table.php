<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_aset_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('aset', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'id_ruangan' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'default' => null,
            ),
            'id_kategori' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'default' => null,
            ),
			'id_kategori_khusus' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'default' => null,
            ),
            'id_spesifikasi' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'null' => true,
                'default' => null,
            ),
            'kode' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ),
            'nama_aset' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'merek' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'kondisi' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'tanggal_penerimaan' => array(
                'type' => 'DATE',
            ),
            'umur_ekonomis' => array(
                'type' => 'INT',
                'constraint' => '8',
                'null' => true,
            ),
            'nilai_aset' => array(
                'type' => 'INT',
                'constraint' => '8',
                'null' => true,
            ),
			'nomor_kursi' => array(
				'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
				'null' =>true, 
			),
			'nomor_identitas' => array(
				'type' => 'INT',
				'constraint' => '8',
				'unsigned' => true,
                'null' => true,
                'default' =>null,
			),
            'gambar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
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
        $this->dbforge->create_table('aset');

        $sql="
            alter table aset 
            add FOREIGN key (id_ruangan) REFERENCES ruangan(id), 
            add FOREIGN key (id_kategori) REFERENCES kategori(id), 
            add FOREIGN key (id_spesifikasi) REFERENCES spesifikasi(id),
			add FOREIGN key (id_kategori_khusus) REFERENCES kategori_khusus(id)";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('aset', true);
    }
}
