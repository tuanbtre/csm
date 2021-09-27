<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePassWordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showchangepass(){
    	return view('csm::Login.passwords.changepassword');
    }
    
    public function changepass(Request $request){
   	
   		$this->validateresetpass($request);
   		$current_password = Auth::user()->password;
   		if(Hash::check($request->oldpass, $current_password))
      	{           
        	$user_id = Auth::User()->id;                       
        	$obj_user = User::find($user_id);
        	$obj_user->password = Hash::make($request->password);
        	$obj_user->save(); 
      	}else{
      		return redirect()->back()->with(['Flass_Message'=>'Mật khẩu củ không trùng khớp']);
      	}
   		return redirect()->back()->with(['Flass_Message'=>'Đổi password thành công']); 
   	}

   	protected function validateresetpass(Request $request)
    {
        $this->validate($request, [
            'oldpass' => 'required',
            'password' => 'required',
            'confirm' => 'required|same:password'	
        ],
        [
            'oldpass.required'=>'Mật khẩu củ không được để trống',
            'password.required'=>'Mật khẩu không được để trống',
            'confirm.required'=>'Xác nhận mật khẩu không được để trống',
            'confirm.same'=>'Mật khẩu và mật khẩu xác nhận không trùng khớp'
        ]);
    }
}
