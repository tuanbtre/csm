@extends('layouts.app')
@section('metaheader')
	@parent
	<meta name="description" content="{!!$metahead->meta_description!!}">
	<meta name="keywords" content="{!!$metahead->keyword!!}">
	<meta property="og:type" content="article">
	<meta property="og:title" content="{!!$record? $record->title : $metahead->title!!}">	
	<meta property="og:image" content="{{asset('images/logo-header.png')}}">
	<meta property="og:description" content="{!!$metahead->meta_description!!}">  
	<title>{!!$record? $record->title : $metahead->title!!}</title>
@endsection
@section('content')
<section class="gioithieu">
   <div class="container-fluid">
     <div class="row justify-content-md-center pt-5">
         <div class="col-12">
            {!!$record->content!!}      
         </div>
      </div>
   </div>
</section>
@endsection