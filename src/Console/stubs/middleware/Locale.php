<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   public function handle($request, Closure $next)
   {
      $language = $this->getlanguage($request);
      App::setLocale($language);
      return $next($request);
   }
   protected function getlanguage($request){
      $currentRouteName = Route::currentRouteName();
      if($currentRouteName =='staticpage')
      {
         $staticpage = DB::table('tbl_staticpage')->where('pagecode', $request->route('pagecode'))->first();
         if($staticpage)
            $language = DB::table('tbl_language')->find($staticpage->language_id)->url_name;
         else{ 
            $route = DB::table('route_language')->join('tbl_language', 'route_language.language_id', '=', 'tbl_language.id')->where('route_name', $request->pagecode)->select('tbl_language.url_name')->first();
            $language = $route? $route->url_name : null;
         }              
      }else{
         $route = DB::table('route_language')->join('tbl_language', 'route_language.language_id', '=', 'tbl_language.id')->where('route_name', $currentRouteName)->select('tbl_language.url_name')->first();
         $language = $route? $route->url_name : null;
      }
      if($language)
         return $language;
      return config('app.locale');
   }
}