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
            <h1 style="background:inherit">Quảng cáo</h1>   
         </div>
         <div class="col-md-6">
            <p style="text-align: right"><input type="checkbox" id="ckbActive" onclick="ShowDeactive()"/> <label for="ckbActive">Ẩn chuyên mục không hoạt động</label></p>
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
      <fieldset >
         <div class="scrollable">
            <table class="table-condensed table-responsive" width="100%">
               <tr>
                  <td style="width: 70%; vertical-align: top">
                     <form id="MainForm" method="post" action="{!! route('admin.advertisement.index') !!}" name="MainForm" enctype="multipart/form-data">
                        @csrf
                        <input type="Hidden" id="Id" name="Id" value="0">
                        <input type="Hidden" id="deleteMode" name="deleteMode" value="0">
                        <input type="hidden" id="l" name="l" value="{!!$current_language!!}">
                        <table class="table-condensed table-responsive" style="width:100%">
                           <thead>
                              <tr>
                                 <td colspan="2" class="cell_header">
                                    Thông tin quảng cáo
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
                                 <label for="title" class="control-label">Tiêu đề</label>
                              </td>
                              <td>
                                 <input type="Text" id="title" name="title" class="form-control">
                              </td>
                           </tr>
                           <tr >
                              <td>
                                 <label for="group" class="control-label">Vị trí</label>
                              </td>
                              <td>
                                 <select required id="group" name="group" class="form-control">
                                    <option value="">Chọn vị trí</option>
                                    <option value="1">Quảng cáo Widget sidebar</option><option value="2">Quảng cáo popup trang chủ</option>
                                 </select>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <label for="brief" class="control-label">Mô tả</label>
                              </td>
                              <td>
                                 <textarea id="brief" name="brief" noneEditor class="form-control" rows="5"></textarea>
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
                                 <label for="new_tab" class="control-label">Mở trang mới</label>
                              </td>
                              <td>
                                 <input type="checkbox" id="new_tab" name="new_tab" value="1" checked="true">
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
                                 <label for="isactive" class="control-label">Hoạt động</label>
                              </td>
                              <td>
                                 <input type="checkbox" id="isactive" name="isactive" value="1" checked="true">
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
                  <td style="width: 25%;vertical-align:top">
                     <table class="table table-responsive table-condensed">
                        <tr>
                           <td colspan="2" class="cell_header">
                              Danh sách quảng cáo
                           </td>
                        </tr>
                        @foreach ($list as $item)
                           <tr>
                              <td class="cell_normal" style="cursor:pointer;" id="row_{!! $item['id'] !!}" onclick="active_item(this);Set('{!! $item['id'] !!}')" data-title="{!! $item['title'] !!}" data-brief="{!! $item['brief'] !!}" data-pagecode="{{$item['pagecode']}}" data-group="{!! $item['group'] !!}" data-url="{!! $item['url'] !!}" data-priority="{!! $item['priority'] !!}" data-image="{!! $item['image'] !!}" data-isactive="{!! $item['isactive'] !!}" data-new-tab="{!!$item['new_tab']!!}">{!! $item['title'] !!}</td>
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
      $('#deleteMode').val('0');
      $('#alert').remove();
      var id_row = 'row_' + _id;
      $('#Id').val(_id);
      SetRecordTextBox('title', id_row, 'data-title', '');
      SetRecordTextBox('oldimage', id_row, 'data-image', '');
      SetRecordTextBox('priority', id_row, 'data-priority', '');
      SetRecordTextBox('brief', id_row, 'data-brief', '');
      SetRecordTextBox('url', id_row, 'data-url', '');
      SetRecordTextBox('group', id_row, 'data-group', '');
      SetRecordTextBox('pagecode', id_row, 'data-pagecode', '');
      SetRecordCheckBox('isactive', id_row, 'data-isactive', '');
      SetRecordCheckBox('new_tab', id_row, 'data-new-tab', '');
   }
   function SetNew() {
      $('#Id').val('0');
      $('#alert').remove();
      $("td[class = 'cell_active']").addClass('cell_normal');
      $("td[class = 'cell_active']").removeClass('cell_active');
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
   function DDLLanguageChange(_lang) {
      document.location.href = '{{ url('admin/advertisement') }}?l=' + _lang;
   }
   function View(field) {
      var filename = $('#' + field).val();
      if (filename == '') return;
      var path = '{{url('images/adbanner')}}/' + filename;
      var newWin = window.open("{{url('admin/quanly-hethong')}}?fn=" + path, "PREVIEW", "width=150, height=200");
      newWin.focus();
   }
   $("#delivery_book").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
   $("#delivery_date").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
  </script>
@endsection