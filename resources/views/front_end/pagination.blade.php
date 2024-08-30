@if ($products->hasPages())
    <nav class="pagination">
        <ul class="page-numbers">
            @if ($products->onFirstPage())
                <li><span class="prev page-numbers">Previous</span></li>
            @else
                <li><a class="prev page-numbers" href="#" data-page="{{ $products->currentPage() - 1 }}">Previous</a></li>
            @endif

            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                <li class="{{ $page == $products->currentPage() ? 'current' : '' }}">
                    <a class="page-numbers" href="#" data-page="{{ $page }}">{{ $page }}</a>
                </li>
            @endforeach

            @if ($products->hasMorePages())
                <li><a class="next page-numbers" href="#" data-page="{{ $products->currentPage() + 1 }}">Next</a></li>
            @else
                <li><span class="next page-numbers">Next</span></li>
            @endif
        </ul>
    </nav>
@endif
