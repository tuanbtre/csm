<?php

namespace Tuanbtre\Csm\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_language')->insert([
			[
				'id' => 1,
				'lang_name' => 'English',
				'url_name' => 'en',
				'flag' => 'flags_en.jpg'
			],
			[
				'id' => 2,
				'lang_name' => 'Vietnam',
				'url_name' => 'vi',
				'flag' => 'flags_vn.jpg'
			]
		]);
    }
}
