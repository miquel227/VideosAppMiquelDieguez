<x-videos-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-6">
            <a href="{{ route('series.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">← Totes les sèries</a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $serie->title }}</h1>
            @if ($serie->description)
                <p class="text-gray-600 mb-3">{{ $serie->description }}</p>
            @endif
            <p class="text-sm text-gray-400">Per {{ $serie->user_name }}</p>
        </div>

        <h2 class="text-lg font-semibold text-gray-900 mb-4">Vídeos de la sèrie</h2>

        @if ($videos->isEmpty())
            <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                <p class="text-gray-500">Aquesta sèrie encara no té vídeos publicats.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($videos as $video)
                    <a href="{{ route('videos.show', $video) }}"
                       class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow block">
                        <div class="p-4">
                            <h3 class="font-medium text-gray-900 mb-1">{{ $video->title }}</h3>
                            @if ($video->description)
                                <p class="text-gray-500 text-sm line-clamp-2">{{ $video->description }}</p>
                            @endif
                            <p class="text-xs text-gray-400 mt-2">{{ $video->formatted_published_at }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-videos-app-layout>
