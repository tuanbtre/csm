@extends('layouts.app')
@section('metaheader')
   @parent
   <meta name="description" content="{!!$metahead->meta_description!!}">
   <meta name="keywords" content="{!!$metahead->keyword!!}">
   <meta property="og:type" content="website">
   <meta property="og:title" content="{!!__('label.search')!!}">
   <meta property="og:image" content="{{$metahead->image? asset('images/'.$metahead->image) : asset('images/logo-header.png')}}">
   <meta property="og:description" content="{!!$metahead->meta_description!!}">  
   <title>{!!__('label.search')!!}</title>
@endsection
@section('content')
<section>
	<hr>
	<nav aria-label="breadcrumb">
	  	<ol class="breadcrumb">
	    	<li class="breadcrumb-item"><a href="{!!route('trangchu')!!}">Trang chủ</a></li>
	    	<li class="breadcrumb-item"><a href="#">Kết quả tìm kiếm</a></li>
	    	<li class="breadcrumb-item active" aria-current="page"> Kết quả tìm kiếm cho " {!!$str!!} "</li>
	  	</ol>
	</nav>
</section>
<section class="gallery-list">
	<div class="container-fluid">
		<div class="row">
			@foreach($list as $item)
			<div class="col-xl-3 col-lg-4 col-md-6">
				<a href="{!!route($item->route, [$item->re_name])!!}" class="hover-effect">
				<img src="{!!asset('images/'.$item->path.$item->image)!!}" width="100%">
				<div class="overlay-gray"></div>
				<div class="figure-caption">
					<p class="id-pro">#116</p>
					<p class="title-pro">{!!$item->title!!}</p>
				</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</section>
@endsection