@if ($paginator->hasPages())
    <div class="flex justify-center text-xs mt-3 ml-auto">
        <div class="inline-flex ml-auto">
            {{-- Previous Page Link --}}
            <a href="{{ $paginator->previousPageUrl() }}"
               aria-label="@lang('pagination.previous')"
               class="bg-transparent text-gray-500 border border-r-0 border-gray-500 font-semibold py-1 px-2
                      {{ $paginator->onFirstPage() ? 'cursor-not-allowed opacity-50' : 'hover:bg-gray-500 hover:text-white' }}">
                <i class="fa fa-fw fa-chevron-left"></i>
            </a>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="bg-transparent text-gray-500 border border-r-0 border-gray-500 font-semibold py-1 px-2 cursor-not-allowed hover:bg-gray-500 hover:text-white">
                        {{ $element }}
                    </a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <a href="{{ $url }}"
                           aria-label="@lang('pagination.previous')"
                           class="bg-transparent py-1 px-2 font-semibold border border-gray-500 border-r-0
                                  {{ $page === $paginator->currentPage() ? 'bg-gray-500 text-white hover:text-white' : 'hover:bg-gray-500 hover:text-white text-gray-500' }}">
                            {{ $page }}
                        </a>
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <a href="{{ $paginator->nextPageUrl() }}"
               aria-label="@lang('pagination.next')"
               class="bg-transparent py-1 px-2 text-gray-500 font-semibold border border-gray-500
                      {{ $paginator->hasMorePages() ? 'hover:bg-gray-500 hover:text-white' : 'cursor-not-allowed opacity-50' }}">
                <i class="fa fa-fw fa-chevron-right"></i>
            </a>
        </div>
    </div>
@endif
