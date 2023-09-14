@extends('Admin.adminapp')
@section('styles')
	@parent
	<link rel="stylesheet" href="{{asset('vendor/csm/css/font-awesome.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/csm/css/tabs.css')}}" />	
@endsection
@section('content')
<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
  	<div class="col-md-12 col-xs-12 padding-0">
    	<h1>Danh sách thành viên quản trị</h1> 
	</div>
  	<div class="page-content padding-30 container-fluid">
    	<div class="col-xs-12 padding-0">
      	<div class="col-md-1 col-sm-1 col-xs-12 padding-left-0">
        		<a class="button-themmoi btn btn-info btn-lg" onclick="SetNew()" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>Thêm mới</a>
      	</div>
	      <div class="col-md-4 col-sm-4 col-xs-12 padding-left-0">
	        	<div class="slinput">
	          	<i class="fa fa-search left-icon"></i> 
	          	<input id="searchstr" name="searchstr" placeholder="Search here">
	          	<a href="{!!route('admin.usermanager.index')!!}"><i class="fa fa-refresh right-icon-re"></i></a>
	          	<i class="fa fa-caret-down right-icon-select"></i> 
	          	<a href="javascript:void(0);" onclick="if(searchstr.value)location.href='{!!route('admin.usermanager.index')!!}?search='+searchstr.value;else searchstr.placeholder='nhập nội dung search'" class="right-icon-a">Tìm kiếm</a>
	        	</div>
	      </div>            
			<div class="pull-right number-row">{{$list->firstItem()}} - {{$list->lastItem()}} của {{$list->total()}}
	         <a href="#" class="button-next"><i class="fa fa-angle-right"></i></a>
	         <div class="dropdown pull-right">
	            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Trang {{$list->currentPage()}}            
	            </button>            
	         </div>
	      </div>
    	</div>
	   @if($list->count())
	    <div class="col-xs-12 padding-0 margin-top-30">
	      <fieldset >
	        <div class="scrollable">
	          <div>
	            <table class="table-user text-center">
	              	<thead>
	                	<tr>
	                  	<th>STT</th>
	                  	<th>Ảnh</th>
	                  	<th>Họ và tên</th>
	                  	<th>Tên tài khoản</th>
	                  	<th>Email</th>
	                  	<th>Hoạt động</th> 
						<th>Tùy chỉnh</th>
	                	</tr>
	              	</thead>
	              	<tbody>
	                	@foreach($list as $key=>$item)
	                	<tr>                              
		                  <td>{!!$key+1!!}</td>
		                  <td>@if (!empty($item->image))
							<img onclick="ViewFile('{!! $item['image'] !!}')" height="30" src="{{url('images/user')}}/{{$item->image}}" alt="{{$item->name}}">
							  @endif</td>
		                  <td>{!!$item->name!!}</td>
		                  <td>{!!$item->username!!}</td>
		                  <td>{!!$item->email!!}</td>
		                  <td><input type="checkbox" name="isactive" {!!$item->isactive==1? 'checked' : ''!!} disabled></td>
		                  <td id="row_{{$item['id']}}" data-name="{{$item['name']}}" data-username="{{$item['username']}}" data-image="{{$item['image']}}" data-phone="{{$item['phone']}}" data-email="{{$item['email']}}" data-isactive="{{$item['isactive']}}" data-priority="{{$item['priority']}}">
		                    <i class="fa fa-pencil" onclick="Set({{$item['id']}})"></i>
		                    <i class="fa fa-times" onclick="SetDeleteMode({{$item['id']}})"></i>
		                  </td>
	                	</tr>
	                	@endforeach
	              </tbody>
	            </table>               
	          </div>
	        </div>                    
	      </fieldset>
	    </div>
	   @endif       
  	</div>   
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="SetNew()" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body areaform">
        <section class="bg-white">
          <form name="MainForm" class="cd-form floating-labels" method="post" action="{!!route('admin.usermanager.index')!!}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="Id" name="Id" value="0">
            <input type="hidden" id="deleteMode" name="deleteMode" value="0">
            <input type="hidden" id="changePass" name="changePass" value="0">
            <legend>Thông tin thành viên</legend>
            <fieldset>
			<div class="col-md-6">
                <label class="cd-label" for="username">Tên tài khoản</label>
                <input type="text" id="username" name="username" required>
              </div>
			  <div class="col-md-6">
                <label class="cd-label" for="name">Họ và tên</label>
                <input id="name" name="name" type="text" required>
              </div> 
              <div class="col-md-6">
                <label class="cd-label" for="phone">Điện thoại</label>
                <input type="text" pattern="[0-9. -]+" id="phone" name="phone" maxlength="50">
              </div>
              <div class="col-md-6">
                <label class="cd-label" for="email">Email</label>
                <input type="email" id="email" name="email" required>
              </div>
              <div class="col-md-6" id="trPassword">
                <label class="cd-label" for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required>
              </div>
              <div class="col-md-6" id="trConfirmPassword">
                <label class="cd-label" for="password_confirmation">Xác nhận mật khẩu</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
              </div>
			  <div class="col-md-4">
                <label class="cd-label" for="oldimage">Ảnh</label>
				<input type="text" readonly="readonly" id="oldimage" name="oldimage" class="form-control" style = "float: left; width:60%">
				<input type="button" id="btnView" name="btnView" value="Xem" style="margin-left:5px;" onclick="View('oldimage')" />
				</div>
			  <div class="col-md-2 padding-30">
                <input type="checkbox" id="isDelete" name="isDelete" value="1"><label class="cd-label" for="isDelete">Xóa ảnh</label>
			  </div>
			  <div class="col-md-6">
                <label class="cd-label" for="image">Upload</label>
				<input type="file" name="image" class="form-control" style = "height: auto">
			  </div>
              <div class="col-md-12">
                <input class="tran-check" type="checkbox" id="isactive" name="isactive" value="1" checked>
                <label for="isactive">Hoạt động</label>        
              </div>
              <div class="col-md-12 text-center">
                <input type="submit" class="btn b-save" value="Lưu thông tin">
                <input type="button" class="btn b-save" onclick="ShowChange()" value="Đổi mật khẩu">
                <input type="reset" class="btn b-normal" onclick="SetNew()" value="Làm lại">
              </div>
            </fieldset>
          </form>
        </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="SetNew()" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
  @parent
  <script src="{{asset('vendor/csm/js/admintool.js')}}"></script>
  <script type="text/javascript">
    function Set(_id) {
      $('#alert').remove();
      $('#changePass').val('0');
      var id_row = 'row_' + _id;
      $('#Id').val(_id);
      SetRecordTextBox('name', id_row, 'data-name', '');
      SetRecordTextBox('oldimage', id_row, 'data-image', '');
      SetRecordTextBox('username', id_row, 'data-username', '');
      SetRecordTextBox('phone', id_row, 'data-phone', '');
      SetRecordTextBox('email', id_row, 'data-email', '');
      SetRecordTextBox('priority', id_row, 'data-priority', '');
      SetRecordCheckBox('isactive', id_row, 'data-isactive', '');
      $('#trPassword').hide().find('input[name="password"]').removeAttr('required');
	    $('#trConfirmPassword').removeAttr('required').hide().find('input[name="password_confirmation"]').removeAttr('required');
      $('#myModal').modal('show');
    }
   function SetNew() {
      $('#Id').val('0');
      $('#deleteMode').val('0');
      $('#changePass').val('0');
      $('#trPassword').show().find('input[name="password"]').prop('required',true);
	   $('#trConfirmPassword').show().find('input[name="password_confirmation"]').prop('required',true);
      document.forms["MainForm"].reset();
   }
   function ShowChange(){
      if ($('#Id').val() == 0)
      {
        	alert('Vui lòng chọn người dùng cần thay đổi');	
      }else{
	      $('#changePass').val('1');
	      $('#trPassword').show().find('input[name="password"]').prop('required',true);
	      $('#trConfirmPassword').show().find('input[name="password_confirmation"]').prop('required',true);
	      $('#password').val('');
	      $('#password_confirmation').val('');
	   }    
	}
   function SetDeleteMode(_id) {
      if(confirm('Bạn có thật sự muốn xóa phần tử này không?'))
      {
          $('#deleteMode').val('1');
          $('#Id').val(_id);
          document.forms["MainForm"].submit();
      }
    }
	function View(field) {
		var filename = $('#' + field).val();
		if (filename == '') return;
		var path = '{{url('images/user')}}/' + filename;
		var newWin = window.open("{{url('admin/quanly-hethong')}}?fn=" + path, "PREVIEW", "width=150, height=200");
		newWin.focus();
	}
	function ViewFile(filename) {
		if (filename == '') return;
		var path = '{{url('images/user')}}/' + filename;
		var newWin = window.open(path, "PREVIEW", "width=150, height=200");
		newWin.focus();
	}
  </script>
@endsection