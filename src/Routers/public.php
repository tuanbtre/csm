<?php

use Illuminate\Support\Facades\Route;
use App\Models\RouteLanguage;
if(Schema::hasTable('route_language'))
	$rl = RouteLanguage::whereNotNull('controlleract')->orderBy('language_id')->get();
else
	$rl = [];
Route::group(['middleware'=>'locale,web'], function () use($rl) {
	foreach($rl as $item)
	{
		try{
			switch ($item->method) {
			   case 'post':
			      Route::post($item->url, $item->controlleract)->name($item->route_name);
			      break;
			   case 'any':
			      Route::any($item->url, $item->controlleract)->name($item->route_name);
			      break;
			   default:
			      Route::get($item->url, $item->controlleract)->name($item->route_name);
			}
		}catch(\Exception $e){	
			continue;
		}	
	}
	Route::any('{all?}', function(){return Redirect::route(__('route.home'))->with(['Flass_Message'=>__('label.errorlink')]);})->where('all','(.*)');
});