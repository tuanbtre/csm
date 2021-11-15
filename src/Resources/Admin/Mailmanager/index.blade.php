<?php $arraytype = array(1=>'Liên hệ', 2=>'Đăng ký lịch tư vấn', 3=>'Nhận hồ sơ online', 4=>'Nhận mail đăng ký đối tác', 5=>'Nhận đăng ký Ebook', 6=>'Nhận đăng ký tuyển dụng', 7=>'Nhận đăng ký hội thảo'); ?>
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
            <h1 style="background:inherit">Quản lý mail</h1>   
         </div>
      </div>      
   </div>
   <div class="page-content padding-30 container-fluid">      
   <div class="col-xs-12 padding-0 margin-top-30">
      <fieldset >
         <div class="scrollable">
            <table class="table-condensed table-responsive" width="100%">
               <tr>
			        	<td style="width: 70%; vertical-align: top">
			            <form id="MainForm" method="post" action="{!! route('admin.mailmanager.index') !!}" name="MainForm" enctype="multipart/form-data">
			               @csrf
		                  <input type="Hidden" id="Id" name="Id" value="0">
		                  <input type="Hidden" id="deleteMode" name="deleteMode" value="0">
			               <table class="table-condensed table-responsive" style="width:100%">
			                  <thead>
			                     <tr>
			                        <td colspan="2" class="cell_header">
			                           Thông tin email
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
			                        <label for="email" class="control-label">Email</label>
			                     </td>
			                  	<td>
			                        <input type="Text" id="email" name="email" class="form-control">
			                     </td>
			                  </tr>
			                  <tr>
			                     <td style="width:20%;">
			                        <label for="type" class="control-label">Nhóm người nhận</label>
			                     </td>
			                     <td>
			                        <select id="type" name="type" class="form-control">
			                           <option value="1">Liên hệ</option>
			                           <option value="2">Đăng ký lịch tư vấn</option>
			                           <option value="3">Nhận hồ sơ online</option>
			                           <option value="4">Nhận mail đăng ký đối tác</option>
			                           <option value="5">Nhận đăng ký Ebook</option>
			                           <option value="6">Nhận đăng ký tuyển dụng</option>
			                           <option value="7">Nhận đăng ký hội thảo</option>
			                        </select>
			                     </td>
			                  </tr>
			                  <tr>
			                     <td></td>
			                     <td align="left">
			                        <input class="btn btn-default" type="reset" id="btnCreate" name="btnCreate" value="Tạo mới" onclick="SetNew()" />
			                     	<input class="btn btn-default" type="submit" id="btnSave" name="btnSave" value="Lưu" />
			                        <input class="btn btn-default" type="button" id="btnDelete" name="btnDelete" value="Xóa" onclick="SetDeleteMode()" />
			                     </td>
			                  </tr>
			               </table>
			            </form>
			        	</td>
			        	<td style="width: 25%;vertical-align:top;">
			            <table class="table table-responsive table-condensed">
			               <tr>
			                  <td colspan="2" class="cell_header">
			                     Danh sách email
			                  </td>
			               </tr>
			               @foreach ($list as $item)
		                  <tr>
		                     <td class="cell_normal" style="cursor:pointer;" id="row_{{$item['id']}}" onclick="active_item(this);Set('{{$item['id']}}')" data-email="{{$item['email']}}" data-type="{{$item['type']}}">
		                               {{$item['email']}}_({!! $arraytype[$item['type']]!!}) 
		                     </td>
		                  </tr>
		                  @endforeach
			               <tr>
			                  <td colspan="2" align="right">
			                     {!! adminpagin($list) !!}
			                  </td>
			               </tr>
			            </table>
			        	</td>
			    	</tr>
            </table>               
         </div>                    
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
   function Set(_id) {
      $('#alert').remove();
      var id_row = 'row_' + _id;
      $('#Id').val(_id);
      SetRecordTextBox('email', id_row, 'data-email', '');
      SetRecordTextBox('type', id_row, 'data-type', '');
   }
   function SetNew() {
      $('#Id').val('0');
      $('#alert').remove();
      $("td[class = 'cell_active']").addClass('cell_normal').removeClass('cell_active');
   }
   function SetDeleteMode(_id) {
      if ($('#Id').val() == 0)
      {  alert('Vui lòng chọn một phần tử trong danh sách');
         event.preventDefault();
         return false;
      }else if(confirm('Bạn có thật sự muốn xóa phần tử này không?')) {
         $('#deleteMode').val('1');
         document.forms["MainForm"].submit();
      }
   }
   function ddlPaggingChange() {
      var _p = $("#ddlPagging :selected").val();
      document.location.href = _p;
   }
   $("#delivery_book").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
   $("#delivery_date").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
  </script>
@endsection