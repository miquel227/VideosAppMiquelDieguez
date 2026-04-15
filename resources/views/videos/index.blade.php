<x-videos-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <h1 class="text-2xl font-bold text-gray-900 mb-6">Tots els vídeos</h1>

        @if ($videos->isEmpty())
            <div class="text-center py-16">
                <p class="text-gray-500 text-lg">Encara no hi ha vídeos publicats.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($videos as $video)
                    <a href="{{ route('videos.show', $video) }}" class="group block bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">

                        <!-- Miniatura (iframe YouTube) -->
                        <div class="relative aspect-video bg-gray-900 overflow-hidden">
                            @php
                                preg_match('/(?:v=|youtu\.be\/)([A-Za-z0-9_-]{11})/', $video->url, $matches);
                                $videoId = $matches[1] ?? null;
                            @endphp
                            @if ($videoId)
                                <img
                                    src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg"
                                    alt="{{ $video->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-800">
                                    <svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Info del vídeo -->
                        <div class="p-3">
                            <h2 class="text-sm font-semibold text-gray-900 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                {{ $video->title }}
                            </h2>
                            @if ($video->description)
                                <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $video->description }}</p>
                            @endif
                            @if ($video->published_at)
                                <p class="text-xs text-gray-400 mt-2">{{ $video->formatted_for_humans_published_at }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-videos-app-layout>
