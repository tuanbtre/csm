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
            <h1 style="background:inherit">Route public</h1>   
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
               <a href="{!!route('admin.routepublic.index',['l'=>$current_language])!!}"><i class="fa fa-refresh right-icon-re"></i></a>
               <i class="fa fa-caret-down right-icon-select"></i> 
               <a href="javascript:void(0);" onclick="if(searchstr.value)location.href='{!!route('admin.routepublic.index',['l'=>$current_language])!!}&search='+searchstr.value;else searchstr.placeholder='Nhập tên route cần tìm'" class="right-icon-a">Tìm kiếm</a>
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
                     <th>Parent</th>
                     <th>Tên route (route_name)</th>
                     <th>Controller-action</th>
                     <th>Method</th>
                     <th>Tên url (url)</th>
                     <th>Tùy chỉnh</th>                      
                  </tr>
               </thead>
               <tbody>
                  @foreach($list as $key=>$item)
                  <tr>                              
                     <td>{!!$loop->iteration+(($list->currentPage()-1)*15)!!}</td>
                     <td>{!!$item->title!!}</td>
                     <td>{!!$item->parent_id!!}</td>
                     <td>{!!$item->route_name!!}</td>
                     <td>{!!$item->controlleract!!}</td>
                     <td>{!!$item->method!!}</td>
                     <td>{!!$item->url!!}</td>
                     <td id="row_{{$item['id']}}" data-title="{{$item['title']}}" data-parent_id="{!!$item['parent_id']!!}" data-route_name="{!!$item['route_name']!!}" data-controlleract="{{$item['controlleract']}}" data-method="{!!$item['method']!!}" data-url="{{$item['url']}}" data-middleware = "{{$item['middleware']}}">
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
          <form name="MainForm" class="cd-form floating-labels" method="post" action="{!!route('admin.routepublic.index')!!}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="Id" name="Id" value="0">
            <input type="Hidden" id="deleteMode" name="deleteMode" value="0">
            <input type="hidden" id="l" name="l" value="{!!$current_language!!}">
            <legend>Thông tin route</legend>
            <fieldset>
               <div class="col-md-6">
                  <label class="cd-label" for="cd-name">Tiêu đề</label>
                  <input required id="title" name="title" type="text">
               </div>
               <div class="col-md-6">
                  <label class="cd-label" for="cd-name">Tên route(route_name)</label>
                  <input id="route_name" name="route_name" type="text" placeholder="gioithieu">
               </div>
               <div class="col-md-6">
                  <label class="cd-label" for="cd-name">Tên url</label>
                  <input id="url" name="url" type="text" placeholder="gioithieu/{name?}">
               </div>
               <div class="col-md-6">
                  <label class="cd-label" for="cd-name">Controller action</label>
                  <input id="controlleract" name="controlleract" type="text" placeholder="AboutusController@index">
               </div>
               <div class="col-md-4">
                  <label class="cd-label" for="cd-name">Method</label>
                  <select id="method" name="method">
                     <option value="get">get</option>
                     <option value="post">post</option>
                     <option value="any">any</option>
                  </select>
               </div>
               <div class="col-md-4">
                  <label class="cd-label" for="cd-name">Parent</label>
                  <select id="parent_id" name="parent_id">
                     <option value="-1">None(dành cho trang ko có banner)</option>
                     <option value="0">Root</option>
                     @foreach($parent as $item)
                     <option value="{!!$item->id!!}">{!!$item->title!!}</option>
                     @endforeach
                  </select>
               </div>
			   <div class="col-md-4">
                  <label class="cd-label" for="cd-name">Middleware</label>
                  <input id="middleware" name="middleware" type="text" placeholder="mail,locale">
               </div>
               <div class="col-md-12 text-center">
                  <input type="submit" class="btn b-save" value="Lưu thông tin">
                  <input type="reset" onclick="SetNew()" class="btn b-normal" value="Làm lại">
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
      SetRecordTextBox('controlleract', id_row, 'data-controlleract', '');
      SetRecordTextBox('url', id_row, 'data-url', '');
      SetRecordTextBox('route_name', id_row, 'data-route_name', '');
      SetRecordTextBox('middleware', id_row, 'data-middleware', '');
      SetRecordComboBox('parent_id', id_row, 'data-parent_id', '');
      SetRecordComboBox('method', id_row, 'data-method', '');
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
   function DDLLanguageChange(_lang) {
      document.location.href = '{{url('admin/route-public')}}?l=' + _lang;
   }
   $("#delivery_book").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
   $("#delivery_date").datepicker({dateFormat: "dd-mm-yy",minDate:"0"});
  </script>
@endsection