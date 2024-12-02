@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-neutral-800 border border-neutral-700 cursor-default rounded-xl">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-neutral-800 border border-neutral-700 rounded-xl hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-spink">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-neutral-800 border border-neutral-700 rounded-xl hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-spink">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-neutral-800 border border-neutral-700 cursor-default rounded-xl">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-400">
                    {!! __('Showing') !!}
                    <span class="font-medium text-white">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-medium text-white">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="font-medium text-white">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rounded-xl">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-neutral-800 border border-neutral-700 cursor-default rounded-l-xl" aria-hidden="true">
                                <i class="fas fa-chevron-left w-5 h-5 flex items-center justify-center"></i>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-400 bg-neutral-800 border border-neutral-700 rounded-l-xl hover:bg-neutral-700 focus:outline-none" aria-label="{{ __('pagination.previous') }}">
                            <i class="fas fa-chevron-left w-5 h-5 flex items-center justify-center"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-neutral-800 border border-neutral-700 cursor-default">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-spink border border-neutral-700 cursor-default">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-400 bg-neutral-800 border border-neutral-700 hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-spink" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-400 bg-neutral-800 border border-neutral-700 rounded-r-xl hover:bg-neutral-700 focus:outline-none" aria-label="{{ __('pagination.next') }}">
                            <i class="fas fa-chevron-right w-5 h-5 flex items-center justify-center"></i>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-neutral-800 border border-neutral-700 cursor-default rounded-r-xl" aria-hidden="true">
                                <i class="fas fa-chevron-right w-5 h-5 flex items-center justify-center"></i>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
