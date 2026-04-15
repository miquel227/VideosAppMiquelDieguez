<x-videos-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Gestió de Sèries</h1>
            @can('create-series')
                <a href="{{ route('series.manage.create') }}"
                   data-qa="create-serie-btn"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors text-sm font-medium">
                    + Afegir sèrie
                </a>
            @endcan
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($series->isEmpty())
            <div class="text-center py-16 bg-white rounded-lg shadow-sm">
                <p class="text-gray-500">Encara no hi ha sèries. <a href="{{ route('series.manage.create') }}" class="text-blue-600 hover:underline">Crea la primera!</a></p>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200" data-qa="series-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Títol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vídeos</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Accions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($series as $serie)
                            <tr class="hover:bg-gray-50" data-qa="serie-row-{{ $serie->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $serie->title }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $serie->user_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $serie->videos->count() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm flex justify-end gap-3">
                                    @can('edit-series')
                                        <a href="{{ route('series.manage.edit', $serie) }}"
                                           data-qa="edit-serie-{{ $serie->id }}"
                                           class="text-blue-600 hover:text-blue-800">Editar</a>
                                    @endcan
                                    @can('delete-series')
                                        <a href="{{ route('series.manage.delete', $serie) }}"
                                           data-qa="delete-serie-{{ $serie->id }}"
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
