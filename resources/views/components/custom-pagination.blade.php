@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center space-x-2 mt-4">
       {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-xs bg-gray-300 text-gray-600 rounded cursor-not-allowed">← Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">← Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-4 py-2 text-xs bg-gray-300 text-gray-600 rounded">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-2 text-xs bg-blue-700 text-white rounded">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-4 py-2 text-xs bg-gray-200 text-gray-700 rounded hover:bg-blue-500 hover:text-white">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">Next →</a>
        @else
            <span class="px-4 py-2 text-xs bg-gray-300 text-gray-600 rounded cursor-not-allowed">Next →</span>
        @endif
    </nav>
@endif
