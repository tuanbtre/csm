<ul class="pagination">
	@if (!$paginator->onFirstPage())
		<li class="pagination-first"><a href="{!! $paginator->url(1) !!}"> Trang đầu </a></li>
  		<li class="pagination-prev"><a href="{!! $paginator->previousPageUrl() !!}" rel="prev"> « </a></li>
	@endif
    @if($paginator->currentPage() > 3)
		<li class="pagination-num"><a href="{!! $paginator->url(1)!!}"> 1 </a></li>
	@endif
	@if($paginator->currentPage() > 4)
        <li class="pagination-num"><span class="page-link">---</span></li>
    @endif
	@foreach(range(1, $paginator->lastPage()) as $i)
        @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
            @if ($i == $paginator->currentPage())
				<li class="pagination-num active"><a> {!! $i !!} </a></li>
		    @else
				<li class="pagination-num"><a href="{!! $paginator->url($i)!!}"> {!!$i!!} </a></li>
		    @endif
        @endif
    @endforeach
	@if($paginator->currentPage() < $paginator->lastPage() - 3)
        <li class="pagination-num"><span class="page-link">---</span></li>
    @endif
    @if($paginator->currentPage() < $paginator->lastPage() - 2)
		<li class="pagination-num"><a href="{{$paginator->url($paginator->lastPage())}}"> {{$paginator->lastPage()}} </a></li>	
	@endif
	@if ($paginator->hasMorePages())
		<li class="pagination-next"><a href="{!! $paginator->nextPageUrl() !!}" rel="next"> » </a></li>
  		<li class="pagination-last"><a href="{!! $paginator->url($paginator->lastPage()) !!}"> Trang cuối </a> </li>
    @endif
</ul>