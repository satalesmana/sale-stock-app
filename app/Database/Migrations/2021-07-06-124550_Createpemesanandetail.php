<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createpemesanandetail extends Migration
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
			'id_pesnan'=> [
				'type'       => 'VARCHAR',
				'constraint' => 5,
			],
			'id_produk'=> [
				'type'       => 'VARCHAR',
				'constraint' => 5,
			],
			'qty'=> [
				'type'       => 'INT',
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('pemesanan_detail');
	}

	public function down()
	{
		$this->forge->dropTable('pemesanan');
	}
}
