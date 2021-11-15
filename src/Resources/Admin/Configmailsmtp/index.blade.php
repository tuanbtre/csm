@extends('Admin.adminapp')
@section('styles')
   @parent
   <link rel="stylesheet" href="{{asset('vendor/csm/css/font-awesome.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('vendor/csm/css/tabs.css')}}" />    
@endsection
@section('content')
<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
   <div class="col-md-12 col-xs-12">
      <div class="row">
         <div class="col-md-6">
            <h1 style="background:inherit">Cập nhật cấu hình mail smtp</h1>   
         </div>        
      </div>      
   </div>
   <div class="page-content padding-30 container-fluid">      
   <div class="col-xs-12 padding-0 margin-top-30">
      <fieldset >
            <table class="table-condensed table-responsive" width="100%">
               <tr>
                  <td style="width: 70%; vertical-align: top">
                     <form id="MainForm" method="post" action="{{route('admin.configmailsmtp.index')}}" name="MainForm" enctype="multipart/form-data">
                        @csrf
                        <input type="Hidden" id="Id" name="Id" value="{!!$record? $record->id:0!!}">
						<input type="Hidden" id="l" name="l" value="{!!$current_language!!}">
						<input type="Hidden" id="deleteMode" name="deleteMode" value="0">
                        <table class="table-condensed table-responsive" style="width:100%">
                           <thead>
                               <tr>
                                   <td colspan="2" class="cell_header">
                                       Cập nhật cấu hình mail smtp
                                   </td>
                               </tr>
                           </thead>
                           <tr>
                              <td></td>
                              <td>
                                 @if ($errors->any())
                                 <div id="alert" class="alert alert-danger">
                                    <ul>
                                       @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                       @endforeach
                                    </ul>
                                 </div>
                                 @endif                              
                              </td>
                           </tr>                        
                           <tr>
                              <td style="width:20%;">
                                 <label for="mail_host" class="control-label">Mail host</label>
                              </td>
                              <td>
                                 <input type="Text" value="{!! $record['mail_host'] !!}" id="mail_host" name="mail_host" class="form-control" required>
                              </td>
                           </tr>                        
                           <tr>
                              <td>
                                 <label for="mail_port" class="control-label">Mail port</label>
                              </td>
                              <td>
								<input type="Text" value="{!! $record['mail_port'] !!}" id="mail_port" name="mail_port" class="form-control" required>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <label for="username" class="control-label">Mail username</label>
                              </td>
                              <td>
                                 <input type="Text" value="{!! $record['username'] !!}" id="username" name="username" class="form-control" required>
                              </td>
                           </tr>
						   <tr>
                              <td>
                                 <label style="width:100%;padding-right:22px" for="password" class="control-label">Mail password</label><i style="margin-left:-22px;font-size:18px" class="fa fa-eye-slash" id="togglePassword"></i>
                              </td>
                              <td>
                                 <input type="Text" value="{!! $record['password'] !!}" id="password" name="password" class="form-control" required>
                              </td>
                           </tr>
						   <tr>
                              <td>
                                 <label for="from_address" class="control-label">Mail from address</label>
                              </td>
                              <td>
                                 <input type="Text" value="{!! $record['from_address'] !!}" id="from_address" name="from_address" class="form-control">
                              </td>
                           </tr>
						   <tr>
                              <td>
                                 <label for="encryption" class="control-label">Mail encryption</label>
                              </td>
                              <td>
                                 <input type="Text" value="{!! $record['encryption'] !!}" id="encryption" name="encryption" class="form-control">
                              </td>
                           </tr>
                           <tr>
                              <td></td>
                              <td align="left">
                                 <input class="btn btn-default" type="submit" id="btnSave" name="btnSave" value="Lưu"/>
								 <input class="btn btn-default" type="button" id="btnDelete" name="btnDelete" value="Xóa" onclick="SetDeleteMode(event)"/>
                              </td>
                           </tr>
                        </table>
                     </form>
                  </td>
               </tr>
            </table>        
      </fieldset>
   </div>          
  </div>  
</div>
@endsection
@section('javascript')
   @parent
   <script src="{{asset('vendor/csm/js/admintool.js')}}"></script>
   <script src="{{asset('vendor/csm/js/number.js')}}"></script>
   <script type="text/javascript">
   function SetDeleteMode(event) {
        if ($('#Id').val() == 0)
        {  event.preventDefault();
           return false;
        }else if(confirm('Bạn có thật sự muốn xóa phần tử này không?')) {
            $('#deleteMode').val('1');
            document.forms["MainForm"].submit();
        }
    }
   function View(_image) {
      if (_image == '') return;
      var path = '{{url('images')}}/' + _image;
      var newWin = window.open("{{url('admin/quanly-hethong')}}?fn=" + path, "PREVIEW", "width=150, height=200");
      newWin.focus();
   }
   $("#togglePassword").mousedown(function() {
         $("#password").prop('type', 'text');
       }).mouseup(function() {
         $("#password").prop('type', 'password');
       }).mouseout(function() {
         $("#password").prop('type', 'password');
       });
   $("#delivery_book").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
   $("#delivery_date").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
  </script>
@endsection