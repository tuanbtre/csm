<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RouteLanguage;
use App\Models\Language;

class RouteLanguageController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }
   public function index(Request $request)
   {
      $language = Language::all();
      $current_language = $request->l?? env('APP_LANG_ADMIN', null); //kiểm tra ngôn ngữ nếu ko có lấy default APP_LANG_ADMIN trong file env
      $strsearch = $request->search;
      if($request->isMethod('get')){
         $parent = RouteLanguage::where([['language_id', $current_language], ['parent_id', 0]])->get(); 
         $list = RouteLanguage::where('language_id', $current_language)->where(function ($query) use($strsearch) {if($strsearch)$query->where('title', 'like', '%'.$strsearch.'%');})->orderBy('id')->paginate(15);
         return view('csm::Routelanguage.index', compact('list', 'parent', 'current_language', 'language'));
      }elseif($request->deleteMode==1){
         $record = RouteLanguage::find($request->Id);
         $record->delete();
         return redirect()->back()->with(['Flass_Message'=>'Xóa dữ liệu thành công']);
      }else{
         $this->validateForm($request); // validate database
         $record = RouteLanguage::updateOrCreate(
            ['id'=>$request->Id],
            ['title'=>$request->title,
             'route_name'=>$request->route_name,
             'controlleract'=>$request->controlleract,
             'method'=>$request->method,
             'url'=>$request->url,
             'parent_id'=>$request->parent_id,
             'language_id'=>$request->l
         ]);
         return redirect()->back()->with(['Flass_Message'=>'cập nhật dữ liệu thành công']);
      }
   }
   protected function validateForm(Request $request)
   {
      $this->validate($request, [
         'title' => 'required',
         'method' => 'required'
      ],
      [
         'title.required'=>'Vui lòng nhập vào tên router',
         'method.required'=>'Vui lòng nhập vào tên phương thức'
      ]);
   }
}
