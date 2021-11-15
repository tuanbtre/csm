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
            <h1 style="background:inherit">Danh sách mail liên hệ</h1>   
         </div>
      </div>      
   </div>
   <div class="page-content padding-30 container-fluid">
      <div class="col-xs-12 padding-0">
         <div class="col-md-4 col-sm-4 col-xs-12 padding-left-0">
            <div class="slinput">
               <i class="fa fa-search left-icon"></i> 
               <input id="searchstr"name="searchstr" placeholder="Search here">
               <a href="{!!route('admin.contactmail.index',['l'=>$current_language])!!}"><i class="fa fa-refresh right-icon-re"></i></a>
               <i class="fa fa-caret-down right-icon-select"></i> 
               <a href="javascript:void(0);" onclick="if(searchstr.value)location.href='{!!route('admin.contactmail.index',['l'=>$current_language])!!}&search='+searchstr.value;else searchstr.placeholder='Nhập nội dung cần tìm'" class="right-icon-a">Tìm kiếm</a>
            </div>
         </div>
         <div class="pull-right number-row">{!!$list->firstItem()!!} - {!!$list->lastItem()!!} của {!!$list->total()!!} <a href="#" class="button-next"><i class="fa fa-angle-right"></i></a>Trang {!!$list->currentPage()!!}</div>
      </div>
   @if($list->count())
   <div class="col-xs-12 padding-0 margin-top-30">
      <fieldset >
         <div class="scrollable">
            <table class="table-user text-center">
               <thead>
                  <tr>
                     <th>STT</th>
                     <th>Họ tên</th>
                     <th>Địa chỉ</th>
                     <th>Email</th>
                     <th>Điện thoại</th>
                     <th>Công ty</th>
                     <th>Tiêu đề</th>
                     <th>Nội dung</th>
                     <th>Tùy chỉnh</th>                      
                  </tr>
               </thead>
               <tbody>
                  @foreach($list as $key=>$item)
                  <tr>                              
                     <td>{!!$key+1!!}</td>
                     <td>{!!$item->fullname!!}</td>
                     <td>{!!$item->address!!}</td>
                     <td>{!!$item->email!!}</td>
                     <td>{!!$item->phone!!}</td>
                     <td>{!!$item->company!!}</td>
                     <td>{!!$item->title!!}</td>
                     <td>{!!$item->content!!}</td>
                     <td id="row_{{$item['id']}}" data-fullname="{!!$item['fullname']!!}" data-content="{!! str_replace('"','&quot;', $item['content']) !!}" data-address="{{$item['address']}}" data-email="{{$item['email']}}" data-phone="{{$item['phone']}}" data-company="{{$item['company']}}" data-title="{{$item['title']}}">
                       <i class="fa fa-eye" onclick="Set({{$item['id']}})"></i>
                       <span style="display: inline-block;"><form method="post" onsubmit="confirmdel(event)" action="{!! route('admin.contactmail.index', ['Id'=>$item['id']]) !!}">@csrf <input type="Hidden" id="deleteMode" name="deleteMode" value="1"><button type="submit" style="border:none"><i class="fa fa-times" onclick="SetDeleteMode({{$item['id']}})"></i></button></form></span>
                     </td>                  
                  </tr>
                  @endforeach
               </tbody>
            </table>               
         </div>                    
      </fieldset>
   </div>
   @endif
   @if($list->lastPage()>1)
      {!!$list->appends(request()->except('page'))->links('Admin.pagination.index')!!}
   @endif       
  </div>  
</div>
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
      <div class="modal-body areaform">
         <section class="bg-white">
          <form name="MainForm" class="cd-form floating-labels" enctype="multipart/form-data">
            <legend>Thông liên hệ</legend>
            <fieldset>
               <div class="col-md-6">
                  <label class="cd-label" for="cd-name">Tiêu đề</label>
                  <input required id="title" name="title" type="text" disabled>
               </div>
               <div class="col-md-6">
                  <label class="cd-label" for="fullname">Họ tên</label>
                  <input id="fullname" name="fullname" type="text" disabled>
               </div>
               <div class="col-md-6">
                  <label class="cd-label" for="address">Địa chỉ</label>
                  <input type="text" name="address" id="address" disabled>
               </div>
               <div class="col-md-6">
                  <label class="cd-label" for="email">Email</label>
                  <input type="email" name="email" id="email" disabled>
               </div>
               <div class="col-md-6">
                  <label class="cd-label" for="phone">Điện thoại</label>
                  <input type="text" id="phone" name="phone" class="form-control" disabled>
               </div>
               <div class="col-md-6">
                  <label class="cd-label" for="company">Công ty</label>
                  <input type="text" id="company" name="company" class="form-control" disabled>
               </div>
               <div class="col-md-12">
                  <label class="cd-label" for="content">Nội dung</label>
                  <textarea id="content" name="content" noneEditor class="form-control" rows="3" disabled></textarea>
               </div>
               <div class="col-md-12 text-center">
                  <input type="reset" onclick="Closeform()" class="btn b-normal" value="Đóng">
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
   <script src="{{asset('vendor/csm/js/number.js')}}"></script>
   <script type="text/javascript">
   function Set(_id) {
      $('#alert').remove();
      var id_row = 'row_' + _id;
      $('#Id').val(_id);
      SetRecordTextBox('title', id_row, 'data-title', '');
      SetRecordTextBox('fullname', id_row, 'data-fullname', '');
      SetRecordTextBox('email', id_row, 'data-email', '');
      SetRecordTextBox('address', id_row, 'data-address', '');
      SetRecordTextBox('phone', id_row, 'data-phone', '');
      SetRecordTextBox('company', id_row, 'data-company', '');
      SetRecordTextBox('content', id_row, 'data-content', '');
      $('#myModal').modal('show');
   }
   function SetNew() {
      $('#Id').val('0');
      document.forms["MainForm"].reset();
   }
   function confirmdel(event){
      if(confirm('Bạn có thật sự muốn xóa phần tử này không?'))
         return true
      else
         event.preventDefault();
   }
   function Closeform(){
      $('#myModal').modal('hide');   
   }
   $("#delivery_book").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
   $("#delivery_date").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
  </script>
@endsection