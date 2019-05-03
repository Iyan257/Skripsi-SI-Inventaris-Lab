<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_rka_aset_temp_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    {
        $this->dbforge->drop_table('rka_aset_temp', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'id_user' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => true,
            ),
            'id_rka_aset' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'null' => true,
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
            'id_aksi' => array(
                'type' => 'INT',
                'constraint' => '3',
                'null' => true,
            ),
        );
        
        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('rka_aset_temp');

        $sql="
            alter table rka_aset_temp
            add FOREIGN key (id_user) REFERENCES users(id),
            add FOREIGN key (id_rka_aset) REFERENCES rka_aset(id) ";
            
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('rka_aset_temp', true);
    }
}
