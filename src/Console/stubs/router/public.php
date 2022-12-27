<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
if(Schema::hasTable('route_language'))
	$rl = DB::table('route_language')->whereNotNull('controlleract')->orderBy('language_id')->orderBy('id')->get();
else
	$rl = [];
Route::group(['namespace'=> 'App\\Http\\Controllers', 'middleware'=>['locale']], function () use($rl) {
	foreach($rl as $item)
	{
		try{
			switch ($item->method) {
			   case 'post':
			      if($item->middleware)
					Route::post($item->url, $item->controlleract)->name($item->route_name)->middleware([$item->middleware]);
				  else
					Route::post($item->url, $item->controlleract)->name($item->route_name);  
			      break;
			   case 'any':
			      if($item->middleware)
					Route::any($item->url, $item->controlleract)->name($item->route_name)->middleware([$item->middleware]);
				  else
					Route::any($item->url, $item->controlleract)->name($item->route_name);  
			      break;
			   default:
			      if($item->middleware)
					Route::get($item->url, $item->controlleract)->name($item->route_name)->middleware([$item->middleware]);
				  else
					Route::get($item->url, $item->controlleract)->name($item->route_name);  
			}
		}catch(\Exception $e){	
			continue;
		}	
	}	
});
Route::fallback(function(){return Redirect::route(__('route.home'))->with(['Flass_Message'=>__('label.errorlink')]);});