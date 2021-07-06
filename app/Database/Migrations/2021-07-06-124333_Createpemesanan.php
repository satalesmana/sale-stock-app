<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createpemesanan extends Migration
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
			'id_pemesan'=> [
				'type'       => 'VARCHAR',
				'constraint' => 5,
			],
			'tgl_pesan'=> [
				'type'       => 'DATE',
			],
			'status'=> [
				'type'       => 'VARCHAR',
				'constraint' => 15,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('pemesanan');
	}

	public function down()
	{
		$this->forge->dropTable('pemesanan');
	}
}
