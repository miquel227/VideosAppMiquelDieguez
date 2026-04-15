<x-videos-app-layout>
    <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('videos.manage') }}" class="text-gray-400 hover:text-gray-600">
                ← Tornar
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Eliminar vídeo</h1>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6" data-qa="delete-confirm-box">

            <div class="flex items-start gap-4 mb-6">
                <div class="flex-shrink-0 bg-red-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-1">Confirmes l'eliminació?</h2>
                    <p class="text-sm text-gray-500">
                        Estàs a punt d'eliminar el vídeo
                        <strong class="text-gray-800" data-qa="video-title">{{ $video->title }}</strong>.
                        Aquesta acció no es pot desfer.
                    </p>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('videos.manage') }}"
                   data-qa="cancel-btn"
                   class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                    Cancel·lar
                </a>
                <form method="POST" action="{{ route('videos.manage.destroy', $video) }}">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        data-qa="confirm-delete-btn"
                        class="px-4 py-2 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition-colors font-medium">
                        Sí, eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-videos-app-layout>
