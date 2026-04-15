<x-videos-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Sèries</h1>
            @can('manage-series')
                <a href="{{ route('series.manage') }}"
                   class="bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200 text-sm">
                    Gestionar sèries
                </a>
            @endcan
        </div>

        <form method="GET" action="{{ route('series.index') }}" class="mb-6">
            <div class="flex gap-2">
                <input type="text" name="search" value="{{ $search }}"
                       placeholder="Cercar sèries per títol..."
                       class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                    Cercar
                </button>
            </div>
        </form>

        @if ($series->isEmpty())
            <div class="text-center py-16 bg-white rounded-lg shadow-sm">
                <p class="text-gray-500">No s'han trobat sèries.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($series as $serie)
                    <a href="{{ route('series.show', $serie) }}"
                       data-qa="serie-card-{{ $serie->id }}"
                       class="bg-white rounded-lg shadow-sm p-5 hover:shadow-md transition-shadow block">
                        <h2 class="text-lg font-semibold text-gray-900 mb-1">{{ $serie->title }}</h2>
                        @if ($serie->description)
                            <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ $serie->description }}</p>
                        @endif
                        <div class="flex items-center justify-between text-xs text-gray-400">
                            <span>{{ $serie->user_name }}</span>
                            <span>{{ $serie->videos->count() }} vídeo(s)</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-videos-app-layout>
