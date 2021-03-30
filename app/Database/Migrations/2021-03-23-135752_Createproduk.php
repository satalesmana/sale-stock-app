<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createproduk extends Migration
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
			'nama_produk'=> [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'kategori'=> [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'gambar' => [
					'type' => 'TEXT',
					'null' => true,
			],
			'harga'=> [
				'type'       => 'INT',
				'constraint' => 15,
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('produks');
	}

	public function down()
	{
		$this->forge->dropTable('produks');
	}
}
