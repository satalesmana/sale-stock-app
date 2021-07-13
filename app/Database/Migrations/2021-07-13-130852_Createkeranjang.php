<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createkeranjang extends Migration
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
			'mac'=> [
				'type'       => 'VARCHAR',
				'constraint' => 30,
			],
			'id_produk'=> [
				'type'       => 'VARCHAR',
				'constraint' => 5,
			],
			'nama_produk'=> [
				'type'       => 'VARCHAR',
				'constraint' => 50,
			],
			'qty'=> [
				'type'       => 'INT',
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('keranjang');
	}

	public function down()
	{
		$this->forge->dropTable('keranjang');
	}
}
