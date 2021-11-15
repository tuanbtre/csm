@extends('layouts.app')
@section('metaheader')
   @parent
   <meta name="description" content="{!!$metahead->meta_description!!}">
   <meta name="keywords" content="{!!$metahead->keyword!!}">
   <meta property="og:type" content="article">
   <meta property="og:title" content="Liên hệ"> 
   <meta property="og:image" content="{{asset('images/logo-header.png')}}">
   <meta property="og:description" content="{!!$metahead->meta_description!!}">  
   <title>Liên hệ</title>
@endsection
@section('content')
<section class="lienhe">
   <div class="container">
      <form name="Contactform" method="post" action="{!!route('maillienhe')!!}">
         @csrf
         <div class="row from-lh">
            <div class="col-lg-6"><h3 class="text-uppercase"><strong>Họ và tên</strong></h3><br><input type="text" id="fullname" name="fullname" class="input" required></div>
            <div class="col-lg-6"><h3 class="text-uppercase"><strong>E-mail</strong></h3><br><input type="email" id="email" name="email" class="input" required></div>
            <div class="col-lg-6"><h3 class="text-uppercase"><strong>Điện thoại</strong></h3><br><input type="text" id="phone" name="phone" class="input" required></div>
            <div class="col-lg-6"><h3 class="text-uppercase"><strong>Địa chỉ</strong></h3><br><input type="text" id="address" name="address" class="input"></div>
            <div class="col-lg-6"><h3 class="text-uppercase"><strong>Công ty</strong></h3><br><input type="text" id="company" name="company" class="input"></div>
            <div class="col-lg-6"><h3 class="text-uppercase"><strong>Tiêu đề</strong></h3><br><input type="text" id="title" name="title" class="input"></div>
            <div class="col-lg-6"><h3 class="text-uppercase"><strong>Nội dung</strong></h3><br><textarea rows="5" id="content" name="content" class="input"></textarea></div>
            <div class="col-lg-12"><button type="submit" class="btn-black mr-3 text-uppercase">Gửi ngay</button><button type="reset" class="btn-black bg-warning ml-3 text-uppercase">Xóa</button></div>
         </div>
      </form>      
   </div>
</section>
@if($map)
<section>
   <div class="row">
      <div class="col-12"><h4 class="title-pro text-uppercase text-center">Xem bản đồ</h4></div>
      <div class="col-12 mt-5 map">
         {!!$map->content!!}
      </div>
   </div>
</section>
@endif
@endsection