<?php

namespace Tuanbtre\Csm\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\RouteLanguage;
use App\Models\Language;
use App\Models\StaticPage;
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
         $staticpage = StaticPage::where('pagecode', $request->route('pagecode'))->first();
         if($staticpage)
            $language = Language::find($staticpage->language_id)->url_name;
         else{ 
            $route = RouteLanguage::where('route_name', $request->pagecode)->first();
            $language = $route? $route->language->url_name : null;
         }              
      }else{
         $route = RouteLanguage::where('route_name', $currentRouteName)->first();
         $language = $route? $route->language->url_name : null;
      }
      if($language)
         return $language;
      return config('app.locale');
   }
}