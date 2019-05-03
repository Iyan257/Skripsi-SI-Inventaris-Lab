<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_rka_aset_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('rka_aset', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'id_rka' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
            ),
            'kegiatan' => array(
                'type' => 'TEXT',
                'default' => null,
            ),
            'nama_barang' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'banyak' => array(
                'type' => 'INT',
                'constraint' => '8',
            ),
            'satuan' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
            ),
            'banyak_disetujui' => array(
                'type' => 'INT',
                'constraint' => '8',
                'null' =>true,
            ),
            'satuan_disetujui' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' =>true,
            ),
            'perkiraan_biaya' => array(
                'type' => 'INT',
                'constraint' => '8',
                'null' => true,
            ),
            'total_terealisasi' => array(
                'type' => 'INT',
                'constraint' => '8',
                'null' => true,
            ),
            'latar_belakang' => array(
                'type' => 'TEXT',
                'null' => true,
                'default' => null,
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        );
        
        $this->db_timestamp->timestamp_field($data);
        $this->db_timestamp->softdelete_field($data);

        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('rka_aset');

        $sql="
            alter table rka_aset 
            add FOREIGN key (id_rka) REFERENCES rka(id) ";
            
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('rka_aset', true);
    }
}
