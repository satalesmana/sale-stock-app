<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;


class MemberSeeder extends Seeder
{
	public function run()
	{
		$this->db->table('member')->insert($this->generateMember());
	}

	private function generateMember(){
		$faker = Factory::create();
        return [
            'nama_member' => $faker->name(),
            'email' => $faker->email,
			'alamat'=>$faker->address,
			'foto'	=> $faker->imageUrl($width = 640, $height = 480) 
        ];
	}
}
