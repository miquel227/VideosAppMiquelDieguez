<x-videos-app-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('videos.manage') }}" class="text-gray-400 hover:text-gray-600">
                ← Tornar
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Detall del vídeo</h1>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-4">
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Títol</p>
                <p class="text-lg font-semibold text-gray-900">{{ $video->title }}</p>
            </div>
            @if ($video->description)
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Descripció</p>
                    <p class="text-sm text-gray-700">{{ $video->description }}</p>
                </div>
            @endif
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">URL</p>
                <a href="{{ $video->url }}" target="_blank" class="text-sm text-blue-600 hover:underline">{{ $video->url }}</a>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Publicat</p>
                <p class="text-sm text-gray-700">{{ $video->formatted_published_at ?? '—' }}</p>
            </div>

            <div class="flex gap-3 pt-4 border-t border-gray-100">
                @can('edit-videos')
                    <a href="{{ route('videos.manage.edit', $video) }}"
                       class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                        Editar
                    </a>
                @endcan
                @can('delete-videos')
                    <a href="{{ route('videos.manage.delete', $video) }}"
                       class="px-4 py-2 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition-colors">
                        Eliminar
                    </a>
                @endcan
            </div>
        </div>
    </div>
</x-videos-app-layout>
