@extends('Admin.adminapp')
@section('styles')
   @parent
   <link rel="stylesheet" href="{{asset('vendor/csm/css/font-awesome.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('vendor/csm/css/tabs.css')}}"/> 
@endsection
@section('content')
<div class="page animsition" style="animation-duration: 800ms; opacity: 1;">
   <div class="col-md-12 col-xs-12">
      <div class="row">
         <div class="col-md-6">
            <h1 style="background:inherit">Danh sách loại tin tức</h1>   
         </div>
         <div class="col-md-6">
            <p style="display: flex; justify-content: right; align-items: center;padding-top:15px;padding-right:15px">Ngôn ngữ &nbsp; <select class="form-control" style="width:18%" onchange = "DDLLanguageChange(this.value)">
               @foreach($language as $item)
                  <option value="{!! $item['id'] !!}" {!! $item['id']==$current_language? "selected" : "" !!}>{!! $item['lang_name'] !!}</option>
               @endforeach
            </select></p>
         </div>         
      </div>      
   </div>
   <div class="page-content padding-30 container-fluid">
      <div class="col-xs-12 padding-0">
         <div class="col-md-1 col-sm-1 col-xs-12 padding-0">
            <a class="button-themmoi btn btn-info btn-lg" onclick="SetNew()" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>Thêm mới</a>
         </div>
         <div class="col-md-4 col-sm-4 col-xs-12 padding-left-0">
            <div class="slinput">
               <i class="fa fa-search left-icon"></i> 
               <input id="searchstr"name="searchstr" placeholder="Search here">
               <a href="{!!route('admin.news.index',['l'=>$current_language])!!}"><i class="fa fa-refresh right-icon-re"></i></a>
               <i class="fa fa-caret-down right-icon-select"></i> 
               <a href="javascript:void(0);" onclick="if(searchstr.value)location.href='{!!route('admin.news.index',['l'=>$current_language])!!}&search='+searchstr.value;else searchstr.placeholder='Nhập nội dung cần tìm'" class="right-icon-a">Tìm kiếm</a>
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
                     <th>Tiêu đề</th> 
                     <th>Hình</th>
                     <th>Thứ tự</th>
                     <th>Hoạt động</th>
                     <th>Tùy chỉnh</th>                      
                  </tr>
               </thead>
               <tbody>
                  @foreach($list as $key=>$item)
                  <tr>                              
                     <td>{!!$loop->iteration+(($list->currentPage()-1)*15)!!}</td>
                     <td>{!!$item->title!!}</td>
                     <td>
                       <img style="cursor:pointer" onclick="ViewFile(this)" height="30" src="{{asset('images/news/category/'.$item->image)}}" alt="{{$item->title}}">
                     </td>
                     <td>{!!$item->priority!!}</td>
                     <td><input type="checkbox" name="isactive" {!!$item->isactive==1? 'checked' : ''!!} disabled></td>
                     <td id="row_{{$item['id']}}" data-title="{{$item['title']}}" data-isactive="{{$item['isactive']}}" data-image="{!! $item['image'] !!}" data-re_name="{{$item['re_name']}}" data-priority="{{$item['priority']}}">
                       <i class="fa fa-pencil" onclick="Set({{$item['id']}})"></i>
                       <i class="fa fa-times" onclick="SetDeleteMode({{$item['id']}})"></i>
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
          <form name="MainForm" class="cd-form floating-labels" method="post" action="{!!route('admin.news.index')!!}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="Id" name="Id" value="0">
            <input type="Hidden" id="deleteMode" name="deleteMode" value="0">
            <input type="hidden" id="l" name="l" value="{!!$current_language!!}">
            <legend>Loại tin tức</legend>
            <fieldset>
               <div class="col-md-5">
                  <label class="cd-label" for="cd-name">Tiêu đề</label>
                  <input required id="title" name="title" type="text">
               </div>
               <div class="col-md-5">
                  <label class="cd-label" for="re_name">Rewrite url</label>
                  <input id="re_name" name="re_name" type="text">
               </div>
               <div class="col-md-12">
                  <label class="cd-label" for="image">Ảnh</label>
                  <input type="Text" readonly="readonly" id="oldimage" name="oldimage" class="form-control" style = "float:left;width:50%">
                  <input type="checkbox" id="isDelete" name="isDelete" value="1" style = "float: left; margin-left:5px;position:relative !important">  &nbsp; Xóa
                  <input type="button" id="btnView" name="btnView" value="Xem" style="margin-left:5px;" onclick="View('oldimage')"/>
               </div> 
               <div class="col-md-12">
                  <label class="cd-label" for="image">Upload ảnh</label>
                  <input type="file" name="image" class="form-control" style = "height: auto">
               </div>
               <div class="col-md-12">
                <label class="cd-label" for="priority">Thứ tự</label>
                <input type="text" id="priority" name="priority">
               </div>
               <div class="col-md-6">
                <input class="tran-check" type="checkbox" id="isactive" name="isactive" value="1" checked>
                <label class="cd-label" for="isactive">Hoạt động</label> 
               </div>             
               <div class="col-md-12 text-center">
                  <input type="submit" class="btn b-save" value="Lưu thông tin">
                  <input type="reset" class="btn b-normal" value="Làm lại">
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
      SetRecordTextBox('re_name', id_row, 'data-re_name', '');
      SetRecordTextBox('oldimage', id_row, 'data-image', '');
      SetRecordTextBox('priority', id_row, 'data-priority', '');
      SetRecordCheckBox('isactive', id_row, 'data-isactive', '');
      $('#myModal').modal('show');
   }
   function SetNew() {
      $('#Id').val('0');
      document.forms["MainForm"].reset();
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
      var path = '{{url('images/news/category')}}/' + filename;
      var newWin = window.open("{{url('admin/quanly-hethong')}}?fn=" + path, "PREVIEW", "width=150, height=200");
      newWin.focus();
   }
   function ViewFile(that){
      var filename = $(that).attr('src');
      if (filename == '') return;
      var newWin = window.open("{{url('admin/quanly-hethong')}}?fn=" + filename, "PREVIEW", "width=150, height=200");
      newWin.focus();
   }
   function DDLLanguageChange(_lang) {
      document.location.href = '{{url('admin/catnews')}}?l=' + _lang;
   }    
   $("#delivery_book").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
   $("#delivery_date").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
  </script>
@endsection