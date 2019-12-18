@if ($paginator->hasPages())
    <div class="flex justify-center">
        <div class="inline-flex">
            {{-- Previous Page Link --}}
            <a href="{{ $paginator->previousPageUrl() }}"
               aria-label="@lang('pagination.previous')" class="g-transparent py-2 px-4
                @if ($paginator->onFirstPage())
                    cursor-not-allowed opacity-50
                @else
                    hover:bg-blue-500 hover:text-white hover:border-transparent
                @endif
                    text-blue-dark font-semibold
                    border border-blue-500 border-r-0 rounded-l-full">
                <i class="fa fa-fw fa-chevron-left"></i> @lang('pagination.previous')
            </a>

            {{-- Next Page Link --}}
            <a href="{{ $paginator->nextPageUrl() }}"
               aria-label="@lang('pagination.next')" class="g-transparent py-2 px-4
                @if ($paginator->hasMorePages())
                    hover:bg-blue-500 hover:text-white hover:border-transparent
                @else
                    cursor-not-allowed opacity-50
                @endif
                    text-blue-dark font-semibold
                    border border-blue-500 rounded-r-full">
                @lang('pagination.next') <i class="fa fa-fw fa-chevron-right"></i>
            </a>
        </div>
    </div>
@endif
