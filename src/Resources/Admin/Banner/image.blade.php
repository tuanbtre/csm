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
            <h1 style="background:inherit"><p class="tool-tile"><a href="{!!route('admin.banner.index').'?l='.$current_language !!}">Nhóm banner</a>&rarr;<a>{!! $cat->title !!}</a></p></h1>   
         </div>
         <div class="col-md-6">
            <p class="tool-tile" style="text-align: right;padding-top:45px;padding-right:20px">
               <input type="checkbox" id="ckbActive" onclick="ShowDeactive()" /> <label for="ckbActive">Ẩn chuyên mục không hoạt động</label>
            </p>   
         </div>                  
      </div>      
   </div>
   <div class="page-content padding-30 container-fluid">      
   <div class="col-xs-12 padding-0 margin-top-10">
      <fieldset >
         <div class="scrollable">
            <table class="table-condensed table-responsive" width="100%">
               <tr>
                  <td style="width: 75%;vertical-align:top;">
                     <form id="MainForm" method="post" action="{{route('admin.banner.detail', [$cat->id])}}" name="MainForm" enctype="multipart/form-data">
                        @csrf
                        <input type="Hidden" id="Id" name="Id" value="0">
                        <input type="Hidden" id="cat_id" name="cat_id" value="{!!$cat->id!!}">
                        <input type="Hidden" id="deleteMode" name="deleteMode" value="0">
                        <input type="Hidden" id="l" name="l" value="{!!$current_language!!}">   
                        <table class="table-condensed table-responsive" style="width:100%">
                           <thead>
                              <tr>
                                 <td colspan="2" class="cell_header">Thông tin banner</td>
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
                              <td></td>
                              <td align="left">
                                 <input class="btn btn-default" type="reset" id="btnCreate" name="btnCreate" value="Tạo mới" onclick="SetNew()" />
                                 <input class="btn btn-default" type="submit" id="btnSave" name="btnSave" value="Lưu" />
                                 <input class="btn btn-default" type="button" id="btnDelete" name="btnDelete" value="Xóa" onclick="SetDeleteMode(event)" />
                              </td>
                           </tr>
                           <tr>
                              <td style="width:20%;">
                                 <label for="title" class="control-label">Tiêu đề</label>
                              </td>
                              <td>
                                 <input type="Text" required id="title" name="title" class="form-control">
                              </td>
                           </tr>
                           <tr>
                              <td>
                                  <label for="brief" class="control-label">Mô tả</label>
                              </td>
                              <td>
                                  <textarea id="brief" name="brief" class="form-control" rows="5"></textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                  <label for="url" class="control-label">Url</label>
                              </td>
                              <td>
                                  <input type="Text" id="url" name="url" class="form-control">
                              </td>
                           </tr>
                           <tr>
                              <td>
                                  <label for="image" class="control-label">Hình ảnh</label>
                              </td>
                              <td>
                                  <input type="Text" readonly="readonly" id="oldimage" name="oldimage" class="form-control" style = "float: left; width: 40%">
                                  <input type="checkbox" id="isDelete" name="isDelete" value="1" style = "float: left; margin-left:5px">  &nbsp; Xóa
                                  <input type="button" id="btnView" name="btnView" value="Xem" style="margin-left:5px;" onclick="View('oldimage')" />
                              </td>
                           </tr>
                           <tr>
                              <td>
                                  <label for="Upload" class="control-label">Upload</label>
                              </td>
                              <td>
                                  <input type="file" name="image" class="form-control" style = "height: auto">
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <label for="priority" class="control-label">Thứ tự</label>
                              </td>
                              <td>
                                 <input type="Text" id="priority" name="priority" class="form-control" value="0">
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <label for="isactive" class="control-label">Hoạt động</label>
                              </td>
                              <td>
                                 <input type="checkbox" id="isactive" name="isactive" value="1">
                                 &nbsp; &nbsp; &nbsp;<label for="popup" class="control-label">Mở cửa sổ mới</label>
                                 <input type="checkbox" id="popup" name="popup" value="1">
                              </td>
                           </tr>
                           <tr>
                              <td></td>
                              <td align="left">
                                 <input class="btn btn-default" type="reset" id="btnCreate" name="btnCreate" value="Tạo mới" onclick="SetNew()" />
                                 <input class="btn btn-default" type="submit" id="btnSave" name="btnSave" value="Lưu" />
                                 <input class="btn btn-default" type="button" id="btnDelete" name="btnDelete" value="Xóa" onclick="SetDeleteMode(event)" />
                              </td>
                           </tr>
                        </table>
                     </form>
                     </td>
                     <td style="width: 25%;vertical-align:top;">
                        <table class="table table-responsive table-condensed">
                           <tr>
                              <td colspan="2" class="cell_header">Danh sách banner</td>
                           </tr>
                           @foreach ($list as $item)
                              <tr>
                                 <td class="cell_normal" style="cursor:pointer;" id="row_{!! $item['id'] !!}" onclick="active_item(this);Set('{!! $item['id'] !!}')" data-title="{!! $item['title'] !!}" data-brief="{{$item->brief}}" data-url="{!! $item['url'] !!}" data-priority="{!! $item['priority'] !!}" data-image="{!! $item['image'] !!}" data-isactive="{!! $item['isactive'] !!}" data-popup="{!! $item['popup'] !!}">{!! $item['title'] !!} 
                                 </td>
                              </tr>
                           @endforeach
                           <tr>
                              <td colspan="2" align="right">
                                 {!! adminpagin($list, $current_language) !!}
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
      SetRecordTextBox('title', id_row, 'data-title', '');
      SetRecordTextBox('oldimage', id_row, 'data-image', '');
      SetRecordTextBox('priority', id_row, 'data-priority', '');
      SetRecordCK('brief', id_row, 'data-brief', '');
      SetRecordTextBox('url', id_row, 'data-url', '');
      SetRecordCheckBox('isactive', id_row, 'data-isactive', '');
      SetRecordCheckBox('popup', id_row, 'data-popup', '');
   }
   function SetNew() {
      $('#Id').val('0');
      $('#alert').remove();
      CKEDITOR.instances['brief'].setData('');
      $("td[class = 'cell_active']").addClass('cell_normal').removeClass('cell_active');
   }
   function SetDeleteMode(event) {
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
   function View(field) {
      var filename = $('#' + field).val();
      if (filename == '') return;
      var path = '{{url('images/banner')}}/' + filename;
      var newWin = window.open("{{url('admin/quanly-hethong')}}?fn=" + path, "PREVIEW", "width=150, height=200");
      newWin.focus();
   }    
  </script>
@endsection