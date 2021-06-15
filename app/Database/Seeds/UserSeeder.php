<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
	public function run()
	{
		$this->db->table('users')->insert($this->generateUsers());
	}

	private function generateUsers(): array
    {
        $faker = Factory::create();
        return [
            'name' => $faker->name(),
            'email' => $faker->email,
			'password'=> $this->hashPassword('welcome123'),
			'jenis'	=> 'admin'
        ];
    }

	private function hashPassword(string $plaintextPassword): string
    {
        return password_hash($plaintextPassword, PASSWORD_BCRYPT);
    }
}
