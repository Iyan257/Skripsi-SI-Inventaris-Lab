<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_ion_auth extends CI_Migration {
	private $tables;

	public function __construct() {
		parent::__construct();
		$this->load->dbforge();

		$this->load->config('ion_auth', TRUE);
		$this->tables = $this->config->item('tables', 'ion_auth');
	}

	public function up() {
		// Drop table 'groups' if it exists
		$this->dbforge->drop_table($this->tables['groups'], TRUE);

		// Table structure for table 'groups'
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type'       => 'VARCHAR',
				'constraint' => '20',
			),
			'description' => array(
				'type'       => 'VARCHAR',
				'constraint' => '100',
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($this->tables['groups']);

		// Dumping data for table 'groups'
		$data = array(
			array(
				'name'        => 'kalab',
				'description' => 'Kepala Laboratorium'
			),
			array(
				'name'        => 'admin',
				'description' => 'Administrator'
			),
			array(
				'name'        => 'input_admin',
				'description' => 'Super Administrator'
			),
		);
		$this->db->insert_batch($this->tables['groups'], $data);

		// Drop table 'users' if it exists
		$this->dbforge->drop_table($this->tables['users'], TRUE);

		// Table structure for table 'users'
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'ip_address' => array(
				'type'       => 'VARCHAR',
				'constraint' => '45'
			),
			'username' => array(
				'type'       => 'VARCHAR',
				'constraint' => '100',
			),
			'password' => array(
				'type'       => 'VARCHAR',
				'constraint' => '80',
			),
			'salt' => array(
				'type'       => 'VARCHAR',
				'constraint' => '40',
				'null'       => TRUE
			),
			'remember_code' => array(
				'type'       => 'VARCHAR',
				'constraint' => '40',
				'null'       => TRUE
			),
			'created_on' => array(
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'   => TRUE,
			),
			'last_login' => array(
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'   => TRUE,
				'null'       => TRUE
			),
			'active' => array(
				'type'       => 'TINYINT',
				'constraint' => '1',
				'unsigned'   => TRUE,
				'null'       => TRUE
			),
			'inisial' => array(
				'type'       => 'varchar',
				'constraint' => '3',
			),
			'name' => array(
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'       => TRUE
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($this->tables['users']);

		// Dumping data for table 'users'
		$data = array (
			array(
				'ip_address'              => '127.0.0.1',
				'username'                => 'kalab',
				'password'                => '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36',
				'salt'                    => '',
				'created_on'              => '1268889823',
				'last_login'              => '1268889823',
				'active'                  => '1',
				'name'              	  => 'Ka. Laboratorium',
				'inisial'				  => 'KAL',
			),
			array(
				'ip_address'              => '127.0.0.1',
				'username'                => 'admin',
				'password'                => '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36',
				'salt'                    => '',
				'created_on'              => '1268889823',
				'last_login'              => '1268889823',
				'active'                  => '1',
				'name'              	  => 'Administrator 1',
				'inisial'				  => 'ADM',
			),
			array(
				'ip_address'              => '127.0.0.1',
				'username'                => 'admin_umum',
				'password'                => '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36',
				'salt'                    => '',
				'created_on'              => '1268889823',
				'last_login'              => '1268889823',
				'active'                  => '1',
				'name'              	  => 'Administrator 2',
				'inisial'				  => 'ADU',
			),
		);
		$this->db->insert_batch($this->tables['users'], $data);


		// Drop table 'users_groups' if it exists
		$this->dbforge->drop_table($this->tables['users_groups'], TRUE);

		// Table structure for table 'users_groups'
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type'       => 'MEDIUMINT',
				'constraint' => '8',
				'unsigned'   => TRUE
			),
			'group_id' => array(
				'type'       => 'MEDIUMINT',
				'constraint' => '8',
				'unsigned'   => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($this->tables['users_groups']);

		// Dumping data for table 'users_groups'
		$data = array(
			array(
				'user_id'  => '1',
				'group_id' => '1',
			),
			array(
				'user_id'  => '2',
				'group_id' => '2',
			),
			array(
				'user_id'  => '2',
				'group_id' => '3',
			),
			array(
				'user_id'  => '3',
				'group_id' => '3',
			),
		);
		$this->db->insert_batch($this->tables['users_groups'], $data);


		// Drop table 'login_attempts' if it exists
		$this->dbforge->drop_table($this->tables['login_attempts'], TRUE);

		// Table structure for table 'login_attempts'
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'MEDIUMINT',
				'constraint'     => '8',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'ip_address' => array(
				'type'       => 'VARCHAR',
				'constraint' => '45'
			),
			'login' => array(
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'       => TRUE
			),
			'time' => array(
				'type'       => 'INT',
				'constraint' => '11',
				'unsigned'   => TRUE,
				'null'       => TRUE
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($this->tables['login_attempts']);

	}

	public function down() {
		$this->dbforge->drop_table($this->tables['users'], TRUE);
		$this->dbforge->drop_table($this->tables['groups'], TRUE);
		$this->dbforge->drop_table($this->tables['users_groups'], TRUE);
		$this->dbforge->drop_table($this->tables['login_attempts'], TRUE);
	}

}
