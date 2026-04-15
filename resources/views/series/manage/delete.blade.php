<x-videos-app-layout>
    <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h1 class="text-xl font-bold text-gray-900 mb-4">Eliminar Sèrie</h1>

            <p class="text-gray-700 mb-2">
                Estàs a punt d'eliminar la sèrie <strong data-qa="serie-title">{{ $serie->title }}</strong>.
            </p>
            <p class="text-gray-500 text-sm mb-6">
                Els vídeos associats a aquesta sèrie quedaran desassignats (no s'eliminaran).
            </p>

            <div class="flex gap-3">
                <form method="POST" action="{{ route('series.manage.destroy', $serie) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" data-qa="serie-delete-confirm"
                            class="bg-red-600 text-white px-5 py-2 rounded hover:bg-red-700 text-sm font-medium">
                        Sí, eliminar
                    </button>
                </form>
                <a href="{{ route('series.manage') }}"
                   class="bg-gray-100 text-gray-700 px-5 py-2 rounded hover:bg-gray-200 text-sm">
                    Cancel·lar
                </a>
            </div>
        </div>
    </div>
</x-videos-app-layout>
