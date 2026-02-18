@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center gap-2">
        
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="btn btn-sm btn-disabled btn-square h-9 w-9 rounded-xl bg-base-100 border border-base-content/10 text-base-content/30 p-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6" /></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-sm btn-square h-9 w-9 rounded-xl bg-base-100 hover:bg-white hover:border-primary hover:text-primary text-base-content/70 border border-base-content/10 transition-all shadow-sm p-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6" /></svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex items-center gap-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="btn btn-sm btn-ghost btn-disabled h-9 w-9 rounded-xl text-base-content/30">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="btn btn-sm h-9 w-9 rounded-xl bg-primary text-primary-content border-none shadow-lg shadow-primary/30 font-bold hover:bg-primary pointer-events-none">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="btn btn-sm h-9 w-9 rounded-xl bg-base-100 hover:bg-base-200 border border-base-content/5 text-base-content/70 hover:text-primary transition-all font-semibold">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-sm btn-square h-9 w-9 rounded-xl bg-base-100 hover:bg-white hover:border-primary hover:text-primary text-base-content/70 border border-base-content/10 transition-all shadow-sm p-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6" /></svg>
            </a>
        @else
            <span class="btn btn-sm btn-disabled btn-square h-9 w-9 rounded-xl bg-base-100 border border-base-content/10 text-base-content/30 p-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6" /></svg>
            </span>
        @endif
    </nav>
@endif