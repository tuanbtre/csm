<nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">
        <!-- Grouping Brand with Toggle for better mobile display -->
  <div class="navbar-header">
      <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a href="{{ route('admin.home') }}" class="navbar-brand">Trang Chủ</a>
  </div>
        <!-- Next nav links in the Navbar -->
  <div id="navbarCollapse" class="collapse navbar-collapse">
    <x-Navbaradmin/>
    @if(Auth::check())
      <div class="navbar-right">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#" title="Manage">Xin chào {{ Auth::user()->name }}!</a></li>              
          <li>
            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log out</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>            
        </ul>
      </div>
    @else
      <div class="navbar-right">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ route('register') }}">Đăng ký</a></li>
          <li><a href="{{ route('login') }}" id="loginLink">Đăng nhập</a></li>          
        </ul>
      </div>
    @endif        
  </div>
</nav>