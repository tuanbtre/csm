<?php

namespace Tuanbtre\Csm\Http\Middleware;

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
            $route = DB::table('route_language')->where('route_name', $request->pagecode)->first();
            $language = $route? $route->language->url_name : null;
         }              
      }else{
         $route = DB::table('route_language')->where('route_name', $currentRouteName)->first();
         $language = $route? $route->language->url_name : null;
      }
      if($language)
         return $language;
      return config('app.locale');
   }
}