<!DOCTYPE html>
<html class="no-js css-menubar" lang="vi">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Newproject </title>
  @section('styles')
  <link rel="stylesheet" href="{{asset('vendor/csm/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/csm/css/bootstrap-extend.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/csm/css/site.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/csm/css/animsition.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/csm/css/jquery-mmenu.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/csm/css/web-icons.css')}}">
  <link rel="stylesheet" href="{{asset('vendor/csm/css/jquery-ui.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('vendor/csm/css/jquery-ui-timepicker-addon.min.css')}}" type="text/css">
  <script src="{{asset('vendor/csm/js/breakpoints.js')}}"></script>
  <script>Breakpoints()</script>
  <link rel="stylesheet" href="{{asset('vendor/csm/css/select2.min.css')}}" />
  <link rel="stylesheet" href="{{asset('vendor/csm/css/style-tdt.css')}}">
  <style>
    .cke_source{max-width: 100% !important}
    .custom-combobox{position: relative; display: inline-block}
    .custom-combobox-toggle{position:absolute;top:0;bottom:0;margin-left:-1px;padding:0}
    .custom-combobox-input{margin:0;padding:5px 10px}
  </style> 
  @show
</head>
<body class="dashboard site-navbar-small">
  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided" data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"  data-toggle="collapse">
        <i class="icon wb-more-horizontal" aria-hidden="true"></i>
      </button>
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
        <a href="{!!route('admin.home')!!}"><img class="navbar-brand-logo" src="{{asset('images/logo_mini_login.png')}}" title="New project">
        <span class="navbar-brand-text hidden-xs">Newproject</span></a>
      </div>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search" data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon wb-search" aria-hidden="true"></i>
      </button>
    </div>
    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <li class="hidden-float" id="toggleMenubar">
            <a data-toggle="menubar" href="#" role="button">
              <i class="icon hamburger hamburger-arrow-left">
                <span class="sr-only">Toggle menubar</span>
                <span class="hamburger-bar"></span>
              </i>
            </a>
          </li>
          <li class="hidden-xs" id="toggleFullscreen">
            <a class="icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
              <span class="sr-only">Toggle fullscreen</span>
            </a>
          </li>
          <li class="hidden-float">
            <a class="icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
            role="button">
              <span class="sr-only">Toggle Search</span>
            </a>
          </li>          
        </ul>
        <!-- End Navbar Toolbar -->
        @if(Auth::check())
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
          <li class="dropdown">
            <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                <img src="{{asset('images/user/'.Auth::user()->image)}}" alt="avatar">
                <i></i>
              </span>
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation">
                <a href="{!!route('admin.showchangepass')!!}" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Đổi mật khẩu</a>
              </li>
              <li class="divider" role="presentation"></li>
              <li role="presentation">
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
                <form id="logout-form" action="{{route('admin.logout')}}" method="POST" style="display: none;">
                   @csrf
               </form>
              </li>
            </ul>
          </li>
        </ul>
        @endif
      </div>
      <!-- End Navbar Collapse -->
      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon wb-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="site-search" placeholder="Search...">
              <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
              data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->
    </div>
  </nav>
   <x-Navbaradmin/>
  @yield('content')
   <footer class="site-footer">
      <div class="site-footer-legal">© {{date('Y')}}</div>   
   </footer>
  @section('javascript')
    @if(Session::has('Flass_Message'))
      <script Language='JavaScript'>
         alert('{!!Session::get('Flass_Message')!!}');
      </script>
     @endif
   @if ($errors->any())
      <script Language='JavaScript'>
         @foreach ($errors->all() as $error)
               alert('{{ $error }}');
         @endforeach
      </script>
   @endif 
    <script src="{{asset('vendor/csm/js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/csm/js/bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/csm/js/jquery-asScroll.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/csm/js/jquery.asScrollable.all.js')}}"></script>
    <script src="{{asset('vendor/csm/js/jquery.mmenu.min.all.js')}}"></script>
    <script src="{{asset('vendor/csm/js/screenfull.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/csm/js/core.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/csm/js/site.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/csm/js/menubar.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/csm/js/v1.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/csm/js/cbpFWTabs.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('vendor/csm/ckeditor/ckeditor.js')}}" charset="utf-8"></script>
    <script src="{{asset('vendor/csm/js/js-crm.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/csm/js/jquery-ui.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/csm/js/jquery-ui-timepicker-addon.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
      window.onload = function()
      {   // replace all of the textareas
         var allTextAreas = document.getElementsByTagName("textarea");
         for (var i=0; i<allTextAreas.length; i++)
         {  if(allTextAreas[i].getAttribute("noneEditor") == null)
            {   
               CKEDITOR.replace(allTextAreas[i].name, {
                  filebrowserUploadMethod: 'form',
                  uploadUrl:"{!!route('ckeditorpasteanddrop', ['_token' => csrf_token(), 'type'=>'Images'])!!}",
                  filebrowserImageBrowseUrl: '{!!url("/laravel-filemanager?type=Images")!!}',
                  filebrowserImageUploadUrl: "{!!route('ckeditorupload', ['_token' => csrf_token(), 'type'=>'Images'])!!}",
                  filebrowserBrowseUrl: "{!!url('/laravel-filemanager?type=Files')!!}",
                  filebrowserUploadUrl: "{!!url('/laravel-filemanager/upload?type=Files&_token='.csrf_token())!!}"
               });
               CKEDITOR.dtd.a.div = 1;
               CKEDITOR.dtd.a.p = 1;
            }
         }
      }
      function setEditorValue(instanceName, text)
      {   // Get the editor instance that we want to interact with.
         var oEditor = CKEDITOR.instances[instanceName];
            // Set the editor contents.
         oEditor.setData(text);
      }
   </script>   
  @show   
</body>
</html>