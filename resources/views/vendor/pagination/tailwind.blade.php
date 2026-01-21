@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

        {{-- MOBILE --}}
        <div class="flex items-center justify-between gap-2 sm:hidden">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span
                    class="px-4 py-2 text-sm text-gray-400 bg-white border border-gray-200 rounded-md cursor-not-allowed">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-4 py-2 text-sm text-blue-600 bg-white border border-gray-300 rounded-md hover:bg-blue-50 transition">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-4 py-2 text-sm text-blue-600 bg-white border border-gray-300 rounded-md hover:bg-blue-50 transition">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span
                    class="px-4 py-2 text-sm text-gray-400 bg-white border border-gray-200 rounded-md cursor-not-allowed">
                    {!! __('pagination.next') !!}
                </span>
            @endif

        </div>

        {{-- DESKTOP --}}
        <div class="hidden sm:flex items-center justify-between">

            {{-- INFO --}}
            <p class="text-sm text-gray-600">
                {!! __('Showing') !!}
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                {!! __('of') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>

            {{-- PAGINATION --}}
            <div class="flex items-center gap-2">

                {{-- Previous Icon --}}
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-2 text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10
                                 l3.293 3.293a1 1 0 01-1.414 1.414l-4-4
                                 a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10
                                 l3.293 3.293a1 1 0 01-1.414 1.414l-4-4
                                 a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                {{-- Pages --}}
                @foreach ($elements as $element)
                    {{-- Dots --}}
                    @if (is_string($element))
                        <span class="px-3 py-2 text-gray-400">{{ $element }}</span>
                    @endif

                    {{-- Numbers --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg shadow">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Icon --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-3 py-2 text-blue-600 bg-white border border-gray-300 rounded-lg hover:bg-blue-50 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10
                                 7.293 6.707a1 1 0 011.414-1.414l4 4
                                 a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span class="px-3 py-2 text-gray-400 bg-white border border-gray-200 rounded-lg cursor-not-allowed">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10
                                 7.293 6.707a1 1 0 011.414-1.414l4 4
                                 a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif

            </div>
        </div>
    </nav>
@endif
