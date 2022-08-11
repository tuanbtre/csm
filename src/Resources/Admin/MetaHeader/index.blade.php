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
            <h1 style="background:inherit">Cập nhật Meta tag</h1>   
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
                  <td style="width: 70%; vertical-align: top">
                     <form id="MainForm" method="post" action="{{route('admin.metaheader.index')}}" name="MainForm" enctype="multipart/form-data">
                        @csrf
                        <input type="Hidden" id="l" name="l" value="{!!$current_language!!}">
                        <table class="table-condensed table-responsive" style="width:100%">
                           <thead>
                               <tr>
                                   <td colspan="2" class="cell_header">
                                       Cập nhật Meta tag
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
                                 <input type="Text" value="{{$record? $record->title : ''}}" id="title" name="title" class="form-control">
                              </td>
                           </tr>                        
                           <tr>
                              <td>
                                 <label for="keyword" class="control-label">KeyWord</label>
                              </td>
                              <td>
                                 <textarea id="keyword" name="keyword" noneEditor class="form-control" rows="5">{{$record? $record->keyword : ''}}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <label for="metadescription" class="control-label">Metadescription</label>
                              </td>
                              <td>
                                 <textarea id="meta_description" name="meta_description" noneEditor class="form-control" rows="5">{{$record? $record->meta_description : ''}}</textarea>
                              </td>
                           </tr>
                           <tr>
                              <td>
                                 <label for="image" class="control-label">Ảnh đại diện</label>
                              </td>
                              <td>
                                 <input type="Text" readonly="readonly" id="oldimage" name="oldimage" value="{!!$record? $record->image : ''!!}" class="form-control" style = "float:left;width:40%">
                                     &nbsp; 
                                 <input type="button" id="btnView" name="btnView" value="Xem" style="margin-left:5px" onclick="View('{!!$record? $record->image : ''!!}')"/>
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
                              <td></td>
                              <td align="left">
                                 <input class="btn btn-default" type="submit" id="btnSave" name="btnSave" value="Lưu"/>
                              </td>
                           </tr>
                        </table>
                     </form>
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
   function DDLLanguageChange(_lang) {
      document.location.href = '{{ url('admin/metaheader') }}?l=' + _lang;
   }
   function View(_image) {
      if (_image == '') return;
      var path = '{{url('images')}}/' + _image;
      var newWin = window.open("{{url('admin/quanly-hethong')}}?fn=" + path, "PREVIEW", "width=150, height=200");
      newWin.focus();
   }
  </script>
@endsection