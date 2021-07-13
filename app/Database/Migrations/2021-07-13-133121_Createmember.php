<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createmember extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'=> [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nama_member'=> [
				'type'       => 'VARCHAR',
				'constraint' => 30,
			],
			'email'=> [
				'type'       => 'VARCHAR',
				'constraint' => 50,
			],
			'alamat'=> [
				'type'       => 'VARCHAR',
				'constraint' => 255,
			],
			'foto'=> [
				'type'       => 'VARCHAR',
				'constraint' => 255,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('member');
	}

	public function down()
	{
		$this->forge->dropTable('member');
	}
}
