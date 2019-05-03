<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_stock_opname_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('stock_opname', true);
        $data = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '8',
                'unsigned' => true,
                'auto_increment' => true,
            ),
            'kode' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,
            ),
        );

        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('stock_opname');

        $this->dbforge->drop_table('status_so', true);
        $data = array(
            'stock_opname' => array(
                'type' => 'INT',
                'constraint' => '2',
            ),
        );

        $this->dbforge->add_field($data);
        $this->dbforge->create_table('status_so');

        $data = array(
			array(
                'stock_opname' => '0',
            ),
		);
		$this->db->insert_batch('status_so', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('stock_opname', true);
    }
}
