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
               <h1 style="background:inherit">Phân quyền quản trị</h1>   
            </div>                  
         </div>      
      </div>
      <div class="page-content padding-30 container-fluid">         
         <div class="col-xs-9 margin-top-30">
            <form id="MainForm" name="MainForm" action="{{route('admin.permission.index')}}" method="post">
               @csrf
               <input type="hidden" id="user_id" name="user_id" value="0" />
               <input type="hidden" id="function_id" name="function_id" value="0" />
               <div class="row">
                  <div class="col-xs-12 .no-gutters">
                     <label for="ischeckall">Chọn tất cả:</label> <input id="ischeckall" type="checkbox" onchange="Check_all(this)" value="all" />
                  </div>
               </div>
               <div class="row" id="tblListFunction">
                  @foreach ($functionlist->where('parent_id', 0) as $item)
                     @if($functionlist->where('parent_id', $item->id)->count())
                     <div class="row">
                        <div class="col-md-4">{!!$item->title_vn!!}</div>
                        <div class="col-md-6">
                           <ul style="list-style-type: none">
                              @foreach($functionlist->where('parent_id', $item->id) as $function)
                              <li>
                                 <input type="checkbox" onchange="checkselect()" id="ckb_{!!$function['id']!!}" name="ckb_func[]" value="{!!$function['id']!!}"/>
                                 <label class="cd-label" for="ckb_{!!$function['id']!!}">{!!$function['title_vn']!!}</label>         
                              </li>
                              @endforeach
                           </ul>
                        </div>
                     </div>
                     @elseif($item->controlleract)
					<div class="row">
                        <div class="col-md-4">{!!$item->title_vn!!}</div>
                        <div class="col-md-6">
                           <ul style="list-style-type: none">
                              <li>
                                 <input type="checkbox" onchange="checkselect()" id="ckb_{!!$item->id!!}" name="ckb_func[]" value="{!!$item->id!!}"/>
                                 <label class="cd-label" for="ckb_{!!$item->id!!}">{!!$item->title_vn!!}</label>         
                              </li>                            
                           </ul>
                        </div>
                     </div>
					 @endif	
                  @endforeach
                  <div class="col-xs-12" style="text-align: center">
                     <input class="btn btn-default" type="submit" id="btnSave" name="btnSave" value="Lưu" onclick="ConfirmForm(event);"/>
                  </div>
               </div>
            </form>            
         </div>
         <div class="col-xs-3 margin-top-30">
            <table class="table table-responsive table-condensed">
               <tr>
                  <td colspan="2" class="cell_header">
                     Danh sách quản trị viên
                  </td>
               </tr>
               @foreach ($userlist as $user)
               <tr>
                  <td class="cell_normal" style="cursor:pointer;" id="row_{{$user['id']}}" onclick="active_item(this);Set({!!$user->id.','.$user->func->pluck('id')!!})">{!! $user['username'] !!}
                  </td>
               </tr>
               @endforeach                        
            </table>          
         </div>
      </div>   
   </div>
@endsection   
@section('javascript')
   @parent
   <script src="{{asset('vendor/csm/js/admintool.js')}}"></script>
   <script src="{{asset('vendor/csm/js/number.js')}}"></script>
   <script type="text/javascript">
   function Check_all(field) {
      var check_all = $(field).prop("checked");
      $('#tblListFunction input[id^="ckb_"]').each(function () {
         $(this).prop("checked", check_all);
      });
   }
   function Set(_userID, _listfunc){
      $('#user_id').val(_userID);
      $('#tblListFunction input[type=checkbox]').each(function () {
         $(this).prop("checked", false);
      });
      $.each(_listfunc, function(i, func){
         $('#ckb_' + func).prop("checked", true);        
      });
      if($('input[id^="ckb_"]').length==_listfunc.length)
         $('#ischeckall').prop("checked", true);
      else
         $('#ischeckall').prop("checked", false);
   }
   function ConfirmForm(event) {
      if ($('#user_id').val() != 0) {
         var _listChecked = '';
         var dash = '';
         $('#tblListFunction input[type=checkbox]').each(function () {
            if ($(this).prop("checked")) {
               _listChecked += dash + $(this).val();
            }
            $('#function_id').val(_listChecked);
            dash = '-';
         });
      }
      else{
         alert('Vui lòng chọn một phần tử trong danh sách');
         event.preventDefault();
         return false;
      }
   }
   function checkselect(){
      if($('input[id^="ckb_"]:checked').length == $('input[id^="ckb_"]').length)
         $('#ischeckall').prop("checked", true);
      else
         $('#ischeckall').prop("checked", false);   
   }
</script>
@endsection