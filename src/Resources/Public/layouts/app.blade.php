<!doctype html>
<html lang="vi">
   <head>
      @section('metaheader')
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="author" content="GCONS">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta property="og:locale" content="{!!__('label.locale')!!}">
      <meta name="format-detection" content="telephone=no">
      <link rel="shortcut icon" href="{{asset('logo.ico')}}"/>
      <meta property="og:url" content="{!!url()->current()!!}">
      @show
      @section('style')
      <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('css/menu-mega.css')}}">   
      <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
      <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">  
      <link rel="stylesheet" href="{{asset('css/gme-style.css')}}">
      <style>.menu_img{display: none}.menu_img_pro{display: block}</style>
      @show
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-204530247-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-204530247-1');
      </script>            
   </head>
   <body>
      <div class="page-overflow">
         <div class="fix-footer">
            <x-Combanner/>
            <x-Topframe/>   
            @yield('content')   
            <x-Comcontact/>                        
         </div>      
         <x-Combottomframe/>            
      </div>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
               <div class="modal-body">
                  <form role="search" method="post" action="{!!route('timkiem')!!}" class="flex search-m">
                     @csrf
                     <span class="[ search-overlay__search-icon ]"><svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path d="M14.9 14.1L10.8 10c.8-1 1.2-2.2 1.2-3.5C12 3.5 9.5 1 6.5 1S1.1 3.5 1.1 6.5 3.6 12 6.6 12c1.3 0 2.5-.5 3.4-1.2l4.1 4.1.8-.8zM6.5 2.3c2.4 0 4.3 1.9 4.3 4.3s-1.9 4.3-4.3 4.3S2.2 9 2.2 6.6c.1-2.4 2-4.3 4.3-4.3z"></path></svg></span>
                     <input type="text" placeholder="Từ khóa tìm kiếm" class="[ search-overlay__input ] [ overlay__input ]" name="q" autocomplete="off" required>
                     <button class="btn-black text-uppercase pl-5 pr-5">Tìm</button>
                  </form>
                  <div class="[ search-overlay__inner-wrap ]">
                     <ul class="[ search-overlay__suggested ] [ overlay__children ] [ text-center ] [ list--bare ]">
                     <li><a href="#" class="sibling-elem" style="opacity: 1;"> Từ khóa 01</a></li>
                     <li><a href="#" class="sibling-elem" style="opacity: 1;">Từ khóa 02</a></li>
                     <li><a href="#" class="sibling-elem" style="opacity: 1;">Từ khóa 03</a></li>
                     <li><a href="#" class="sibling-elem" style="opacity: 1;">Download A Brochure</a></li>
                     <li><a href="#" class="sibling-elem" style="opacity: 1;">Từ khóa 04</a></li>
                     <li><a href="#" class="sibling-elem" style="opacity: 1;">Find Us</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @section('javascript')
      <script src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
      <script src="{{asset('js/bootstrap.min.js')}}"></script>
      <script src="{{asset('js/menu.js')}}"></script>
      <script src="{{asset('js/swiper.min.js')}}"></script>
      @show
      <script type="text/javascript">
         $('.prolist li').hover(function(){$(this).closest('ul.prolist').
siblings('.img-thum').find('img').attr('src', $(this).attr('data_src'))}, function(){$(this).closest('ul.prolist').
siblings('.img-thum').find('img').attr('src', $(this).closest('ul.prolist').
siblings('.img-thum').find('img').attr('data_src'))});
      </script>
      @if(Session::has('Flass_Message'))
         <script Language='JavaScript'>
            alert('{!!Session::get('Flass_Message')!!}');
         </script>
      @endif
      @if($errors->any())
         <script Language='JavaScript'>
            @foreach ($errors->messages() as $key=>$error)
               alert('{{ $error[0] }}');
               $('#{!!$key!!}').focus();
               @break
            @endforeach
         </script>
      @endif
   </body>
</html>