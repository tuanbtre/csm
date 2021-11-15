<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
if(Schema::hasTable('tbl_function'))
$r = DB::table('tbl_function')->whereNotNull('controlleract')->orderBy('parent_id')->orderBy('id')->get();
else
$r = [];	
Route::group(['prefix'=>'admin','namespace'=> 'App\\Http\\Controllers\\Admin'], function ()use($r) {
   Route::get('login', ['as'=>'admin.login', 'uses'=>'LoginController@showLoginForm']);
   Route::post('login','LoginController@login');
   Route::post('changepass', ['as'=>'admin.changepass', 'uses'=> 'ChangePassWordController@changepass']);
   Route::post('logout',['as'=>'admin.logout', 'uses'=>'LoginController@logout']);
   Route::get('', ['as'=>'admin.home', 'uses'=>'HomeController@index']);
   Route::get('quanly-hethong', ['as'=>'admin.quanlyhethong.viewfile', 'uses'=>'HomeController@viewfile']);
   foreach($r as $item){
		try{
			switch ($item->method) {
			   case 'post':
			      if($item->can_grant)
					Route::post($item->url, $item->controlleract)->name($item->route_name)->middleware('checkright');
				  else
					Route::post($item->url, $item->controlleract)->name($item->route_name);  
			      break;
			   case 'any':
				  if($item->can_grant)
					Route::any($item->url, $item->controlleract)->name($item->route_name)->middleware('checkright');
				  else
					Route::any($item->url, $item->controlleract)->name($item->route_name);  
			      break;
			   default:
			      if($item->can_grant)
					Route::get($item->url, $item->controlleract)->name($item->route_name)->middleware('checkright');
			      else 
					Route::get($item->url, $item->controlleract)->name($item->route_name);  
			}
		}catch(\Exception $e){	
			continue;
		}
   }	
   Route::any('route-admin', ['as'=>'admin.routeadmin.index','uses'=>'RouteAdminController@index']);
   Route::any('route-public', ['as'=>'admin.routepublic.index','uses'=>'RouteLanguageController@index']);
   Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditorupload');
   Route::post('ckeditor/pasteanddrop', 'CKEditorController@pasteanddrop')->name('ckeditorpasteanddrop');
   Route::fallback(function(){return Redirect::route('admin.home')->with(['Flass_Message'=>'Liên kết không tồn tại']);});
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth:admin']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
});	