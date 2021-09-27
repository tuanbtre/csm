<?php

namespace App\Http\Controllers\Admin;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Functions;
use App\Models\User;
class UserpermissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        if($request->isMethod('get')){
			$functionlist = Functions::where('can_grant',1)->orWhere(function($query){$query->where('isshow', 1)->whereNull('route_name');})->get();
			$userlist = User::where([['isadmin',0],['isactive',1]])->get();    	
			return view('csm::Userpermission.index', compact('functionlist','userlist'));	
		}else{
			$user = User::find($request->user_id);
			$listfunc = $request->ckb_func;
			$user->func()->sync($listfunc);
			return back()->with(['Flass_Message'=>'Cập nhật dữ liệu thành công']);	
		}	
	}        
}