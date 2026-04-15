<x-videos-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Gestió de Vídeos</h1>
            @can('create-videos')
                <a href="{{ route('videos.manage.create') }}"
                   data-qa="create-video-btn"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors text-sm font-medium">
                    + Afegir vídeo
                </a>
            @endcan
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($videos->isEmpty())
            <div class="text-center py-16 bg-white rounded-lg shadow-sm">
                <p class="text-gray-500">Encara no hi ha vídeos. <a href="{{ route('videos.manage.create') }}" class="text-blue-600 hover:underline">Crea el primer!</a></p>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200" data-qa="videos-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Títol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Publicat</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Accions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($videos as $video)
                            <tr class="hover:bg-gray-50" data-qa="video-row-{{ $video->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $video->title }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ $video->url }}" target="_blank" class="text-sm text-blue-500 hover:underline truncate max-w-xs block">
                                        {{ $video->url }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $video->formatted_published_at ?? '—' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm flex justify-end gap-3">
                                    <a href="{{ route('videos.show', $video) }}"
                                       data-qa="view-video-{{ $video->id }}"
                                       class="text-gray-500 hover:text-gray-700">Veure</a>
                                    @can('edit-videos')
                                        <a href="{{ route('videos.manage.edit', $video) }}"
                                           data-qa="edit-video-{{ $video->id }}"
                                           class="text-blue-600 hover:text-blue-800">Editar</a>
                                    @endcan
                                    @can('delete-videos')
                                        <a href="{{ route('videos.manage.delete', $video) }}"
                                           data-qa="delete-video-{{ $video->id }}"
                                           class="text-red-600 hover:text-red-800">Eliminar</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-videos-app-layout>
