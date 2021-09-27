<ul class="pagination">
  	@if($paginator->currentPage()!==1)
  		<li class="pagination-first"><a href="{!! $paginator->url(1) !!}"> Trang đầu </a></li>
  		<li class="pagination-prev"><a href="{!! $paginator->previousPageUrl() !!}" rel="prev"> « </a></li>
	  @else
		<li class="pagination-first"><a> Trang đầu </a></li>
  		<li class="pagination-prev"><a rel="prev"> « </a></li>
	  @endif
  	@for($i=1; $i<=$paginator->lastPage(); $i++)
  		@if($paginator->currentPage()==$i)
  			<li class="pagination-num current"><a> {!! $i !!} </a></li>
  		@else
  			<li class="pagination-num"><a href="{!! $paginator->url($i)!!}"> {!!$i!!} </a></li>
  		@endif
  	@endfor
  	@if($paginator->currentPage()!==$paginator->lastPage())
  		<li class="pagination-next"><a href="{!! $paginator->nextPageUrl() !!}" rel="next"> » </a></li>
  		<li class="pagination-last"><a href="{!! $paginator->url($paginator->lastPage()) !!}"> Trang cuối </a> </li>
  	@else
  		<li class="pagination-next"><a rel="next"> » </a></li>
  		<li class="pagination-last"><a> Trang cuối </a> </li>
  	@endif			
</ul>