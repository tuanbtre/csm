<?php

namespace Tuanbtre\Csm\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
			[
				'id' => 1,
				'name' => 'Administrator',
				'isadmin' => 1,
				'username' => 'administrator',
				'image' => 'Sw1zizEJsdJofVCDuP8ZHuQ5gQFHy0OanLjrzf58.jpg',
				'phone' => '091810000',
				'address' => '103 pasteur p Bến Nghé Q1 TPHCM',
				'email' => 'tuancsharp@gmail.com',
				'email_verified_at' => now(),
				'isactive' => 1,
				'password' => '$2y$10$TJixClYfJ33iz/Fnf/No/ew.rRknMXOVQyuA64T3xHFmeWrMk/fAq', //websrv
				'remember_token' => Str::random(10),
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'id' => 2,
				'name' => 'Nguyễn Minh Tuấn',
				'isadmin' => 0,
				'username' => 'tuanbtre',
				'image' => 'Sw1zizEJsdJofVCDuP8ZHuQ5gQFHy0OanLjrzf58.jpg',
				'phone' => '0918103456',
				'address' => '103 pasteur p Bến Nghé Q1 TPHCM',
				'email' => 'tuannm@tdt-tanduc.com',
				'email_verified_at' => now(),
				'isactive' => 1,
				'password' => '$2y$10$TJixClYfJ33iz/Fnf/No/ew.rRknMXOVQyuA64T3xHFmeWrMk/fAq', //websrv
				'remember_token' => Str::random(10),
				'created_at' => now(),
				'updated_at' => now()
			]
		]);	
    }
}
