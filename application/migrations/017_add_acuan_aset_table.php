<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_acuan_aset_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    {
        $this->dbforge->drop_table('acuan_aset', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'jenis_acuan' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'nilai_acuan' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        );

        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('acuan_aset');

        $data = array(
			array(
                'jenis_acuan' => 'kondisi',
                'nilai_acuan' => 'baik',
            ),
            array(
                'jenis_acuan' => 'kondisi',
                'nilai_acuan' => 'sedang diperbaiki',
            ),
            array(
                'jenis_acuan' => 'kondisi',
                'nilai_acuan' => 'dioper ke BTI',
            ),
            array(
                'jenis_acuan' => 'kondisi',
                'nilai_acuan' => 'rusak',
            ),
		);
		$this->db->insert_batch('acuan_aset', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('acuan_aset', true);
    }
}
