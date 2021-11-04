<div class="site-menubar">
  	<ul class="site-menu">
    	@foreach($listfunc->where('parent_id', 0) as $item)
      <li class="site-menu-item has-sub">
        	<a href="{!!$item->controlleract? route($item->route_name) : '#'!!}">
          	<i><img src="{{asset('images/icon/'.$item->icon)}}" alt=""/></i>
          	<span class="site-menu-title">{{$item->title_vn}}</span>	
          	@if($item->sub->count())
			  	<span class="site-menu-arrow"></span>
        	</a>
         <ul class="site-menu-sub">
            @foreach($listfunc->where('parent_id', $item->id) as $subitem)	
            <li class="site-menu-item">
            	<a class="animsition-link" href="{!!$subitem->controlleract? route($subitem->route_name) : '#'!!}">
              	<span class="site-menu-title">{!!$subitem->title_vn!!}</span>
            	</a>
          	</li>
            @endforeach          	          
        	</ul>
			@else
			</a>
         @endif
      </li>
    	@endforeach     
 	</ul>
</div>