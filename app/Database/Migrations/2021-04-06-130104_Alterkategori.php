<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alterkategori extends Migration
{
	public function up()
	{
		$fields = [
			'kategori' => [
					'name' => 'kategori_id',
					'type' => 'INT',
			],
		];
		$this->forge->modifyColumn('produks', $fields);
	}

	public function down()
	{
		$this->forge->dropTable('produks');
	}
}
