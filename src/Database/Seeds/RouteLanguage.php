<?php

namespace Tuanbtre\Csm\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouteLanguage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('route_language')->insert([
			[
				'route_name' => 'trangchu',
				'url' => null,
				'controlleract' => 'HomeController@index',
				'method' => 'get',
				'title' => 'Trang chủ',
				'parent_id' => 0,
				'language_id' => 2,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'route_name' => 'gioithieu',
				'url' => 'gioi-thieu/{name?}',
				'controlleract' => 'AboutusController@index',
				'method' => 'get',
				'title' => 'Giới thiệu',
				'parent_id' => 0,
				'language_id' => 2,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'route_name' => 'maillienhe',
				'url' => 'mail-lien-he',
				'controlleract' => 'ContactController@sendmail',
				'method' => 'post',
				'title' => 'Mail liên hệ',
				'parent_id' => -1,
				'language_id' => 2,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'route_name' => 'tintuc',
				'url' => 'tin-tuc/{name?}',
				'controlleract' => 'NewsController@index',
				'method' => 'get',
				'title' => 'Tin tức',
				'parent_id' => 0,
				'language_id' => 2,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'route_name' => 'tinct',
				'url' => 'tin-chi-tiet/{name?}',
				'controlleract' => 'NewsController@detail',
				'method' => 'get',
				'title' => 'Tin tức',
				'parent_id' => 7,
				'language_id' => 2,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'route_name' => 'timkiem',
				'url' => 'tim-kiem',
				'controlleract' => 'SearchController@index',
				'method' => 'any',
				'title' => 'Tìm kiếm',
				'parent_id' => 0,
				'language_id' => 2,
				'created_at' => now(),
				'updated_at' => now()
			],
			[
				'route_name' => 'staticpage',
				'url' => '{pagecode?}',
				'controlleract' => 'StaticPageController@index',
				'method' => 'get',
				'title' => 'Các trang tĩnh',
				'parent_id' => -1,
				'language_id' => 2,
				'created_at' => now(),
				'updated_at' => now()
			]
		]);
    }
}
