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
            <h1 style="background:inherit">Phân trang</h1>   
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
   <div class="col-xs-12 padding-0 margin-top-30">
      <fieldset >
         <div class="scrollable">
            <table class="table-condensed table-responsive" width="100%">
               <tr>
                  <td style="width: 75%;vertical-align:top;">
                     <form id="MainForm" method="post" action="{{route('admin.pagging.index')}}" name="MainForm" enctype="multipart/form-data">
                        @csrf
                        <input type="Hidden" id="Id" name="Id" value="0">
                        <input type="Hidden" id="deleteMode" name="deleteMode" value="0">
                        <input type="Hidden" id="l" name="l" value="{!!$current_language!!}">   
                        <table class="table-condensed table-responsive" style="width:100%">
                           <thead>
                              <tr>
                                 <td colspan="2" class="cell_header">Thông tin phân trang</td>
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
                              <td style="width:20%;">
                                 <label for="title" class="control-label">Mã trang</label>
                              </td>
                              <td>
                                 <input type="Text" required id="route_name" name="route_name" class="form-control">
                              </td>
                           </tr>
                           <tr>
                              <td style="width:20%;">
                                 <label for="title" class="control-label">Số tin/trang</label>
                              </td>
                              <td>
                                 <input type="Text" id="numofpage" name="numofpage" class="form-control">
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
                     <td style="width: 25%;vertical-align:top;">
                        <table class="table table-responsive table-condensed">
                           <tr>
                              <td colspan="2" class="cell_header">Danh sách trang</td>
                           </tr>
                           @foreach ($list as $item)
                              <tr>
                                 <td class="cell_normal" style="cursor:pointer;" id="row_{{$item['id']}}" onclick="active_item(this);Set('{{$item['id']}}')" data-title="{{$item['title']}}" data-route_name="{!! $item['route_name'] !!}" data-numofpage="{!! $item['numofpage']!!}" data-priority="{{$item['priority']}}">
                                        {{$item['title']}}</td>
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
      SetRecordTextBox('route_name', id_row, 'data-route_name', '');
      SetRecordTextBox('priority', id_row, 'data-priority', '');
      SetRecordTextBox('numofpage', id_row, 'data-numofpage', '');
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
   function DDLLanguageChange(_lang) {
      document.location.href = '{{url('admin/pagging')}}?l=' + _lang;
   }
   $("#delivery_book").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
   $("#delivery_date").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
  </script>
@endsection