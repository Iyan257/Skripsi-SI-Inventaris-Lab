<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_permintaan_table extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->library('db_timestamp');
    }

    public function up()
    {
        $this->dbforge->drop_table('permintaan', true);
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
            'rencana_tahun' => array(
                'type' => 'INT',
                'constraint' => '8',
            ),
            'judul' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'deskripsi' => array(
                'type' => 'TEXT',
            ),
            'dibaca' => array(
                'type' => 'INT',
                'constraint' => '2',
            ),
        );

        $this->db_timestamp->timestamp_field($data);
        $this->db_timestamp->softdelete_field($data);

        
        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('permintaan');

        $sql="
            alter table permintaan 
            add FOREIGN key (id_user) REFERENCES users(id)";
            
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('permintaan', true);
    }
}
