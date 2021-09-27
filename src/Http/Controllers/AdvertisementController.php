<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Advertisement;
use App\Models\Language;
use Storage;

class AdvertisementController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth:admin');
   }
   public function index(request $request)
   {
      $language = Language::all();
      $current_language = $request->l?? env('APP_LANG_ADMIN', null); //kiểm tra ngôn ngữ nếu ko có lấy default APP_LANG_ADMIN trong file env
      $path  = "adbanner";
      $re_name  = Str::slug($request->title, '-');
      if($request->isMethod('get')){
            $list = Advertisement::where('language_id', $current_language)->paginate(15);
            return view('csm::Advertisement.index', compact('list', 'current_language', 'language'));
      }elseif($request->deleteMode==1){//Xóa
         $record = Advertisement::find($request->Id);
         $image = $record->image;
         $img = Advertisement::where([['image',$record->image],['id','<>',$record->id]])->get()->toArray();
         if($image!=='' && !$img){
            try{
               Storage::delete($path.'/'.$image);    
            }catch(\Exception $e){
               return redirect()->back()->with(['Flass_Message'=>'Có lỗi xảy ra khi xóa file ảnh']);
            }                
         }
         $record->delete();
         return redirect()->back()->with(['Flass_Message'=>'Xóa dữ liệu thành công']);
      }else{
         $this->validateAdvertisement($request); // validate database
         $fileimage = FunctionUpload($request->isDelete, $path, 'image', $request->oldimage);
         $priority = $request->priority==0? Advertisement::where('language_id', $request->l)->max('priority')+1 : $request->priority;
         $record = Advertisement::updateOrCreate(
            ['id'=>$request->Id],
            ['title'=>$request->title,
             'brief'=>$request->brief, 
             'url'=>$request->url,
             'new_tab'=>$request->new_tab,
             'image'=>$fileimage,
             'group'=>$request->group,
             'priority'=>$priority,
             'language_id'=>$request->l,
             'isactive'=>($request->isactive==1)? 1 : 0
         ]);             
         return redirect()->back()->with(['Flass_Message'=>'cập nhật dữ liệu thành công']);
      }    
   }   
   //Kiểm tra dữ liệu 
   protected function validateAdvertisement(Request $request)
    {
      $this->validate($request, [
         'title' => 'required|unique:advertisement,title,'.$request->Id.',id,language_id,'.$request->l,
         'group' => 'required',
         'image' => 'image|max:1024'
        ],
        [
         'title.required'=>'Vui lòng nhập vào tiêu đề',
         'title.unique'=>'Tiêu đề đã tồn tại',
         'group.required' => 'Nhóm banner không được rỗng',
         'image.image'=>'Ảnh không hợp lệ',
         'image.max'=>'Kích thước ảnh vượt quá giới hạn 1MB'
      ]);
   }
}
