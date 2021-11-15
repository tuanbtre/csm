@extends('layouts.app')
@section('metaheader')
   @parent
   <meta name="description" content="{!!$page? $page->meta_description : $metahead->meta_description!!}">
   <meta name="keywords" content="{!!$page? $page->keyword : $metahead->keyword!!}">
   <meta property="og:type" content="article">
   <meta property="og:title" content="{!!$page? $page->title : $metahead->title!!}">  
   <meta property="og:image" content="{{asset('images/staticpage/'.$page->image)}}">
   <meta property="og:description" content="{!!$page? $page->meta_description : $metahead->meta_description!!}">  
   <title>{!!$page? $page->title : $metahead->title!!}</title>
@endsection
@section('content')
<section class="gioithieu">
   <div class="container-fluid">
     <div class="row justify-content-md-center pt-5">
         <div class="col-12">
            {!!$page->content!!}      
         </div>
      </div>
   </div>
</section>
@endsection