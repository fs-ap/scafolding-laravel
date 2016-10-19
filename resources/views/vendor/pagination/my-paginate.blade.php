@if (isset($paginator))
    <ul class="pagination pull-right">
        <!-- Previous Page Link -->
        @if (!array_key_exists('previous', $paginator['links']))
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{$paginator['links']['previous']}}" rel="prev">&laquo;</a></li>
        @endif
        
        <!-- Pagination Elements -->
        @for ($i = 1; $i <= $paginator['total_pages']; $i++)
                @if ($i == $paginator['current_page'])
                    <li class="active"><span>{{ $i }}</span></li>
                @else
                    <li><a href="{{ Request::fullUrl() . "?&page=$i"}}">{{ $i }}</a></li>
                @endif
        @endfor
        <!-- Next Page Link -->
        @if (array_key_exists('next',$paginator['links']))
            <li><a href="{{ $paginator['links']['next'] }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif
