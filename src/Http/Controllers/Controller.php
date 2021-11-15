<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public function __construct()
	{
		$url_name = \Session::get('locale', config('app.locale'));
		$language_id = DB::table('tbl_language')->where('url_name', $url_name)->value('id');
		$metahead = DB::table('meta_header')->where('language_id', $language_id)->first();
		view()->share('metahead', $metahead);
	}
}
