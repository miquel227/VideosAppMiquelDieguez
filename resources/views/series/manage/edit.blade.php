<x-videos-app-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex items-center mb-6 gap-3">
            <a href="{{ route('series.manage') }}" class="text-gray-500 hover:text-gray-700 text-sm">← Tornar</a>
            <h1 class="text-2xl font-bold text-gray-900">Editar Sèrie</h1>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <form method="POST" action="{{ route('series.manage.update', $serie) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="title">Títol *</label>
                    <input type="text" name="title" id="title" data-qa="serie-title"
                           value="{{ old('title', $serie->title) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="description">Descripció</label>
                    <textarea name="description" id="description" data-qa="serie-description" rows="4"
                              class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $serie->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="user_name">Nom de l'autor *</label>
                    <input type="text" name="user_name" id="user_name" data-qa="serie-user-name"
                           value="{{ old('user_name', $serie->user_name) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('user_name') border-red-500 @enderror">
                    @error('user_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="user_photo_url">URL foto de l'autor</label>
                    <input type="url" name="user_photo_url" id="user_photo_url" data-qa="serie-user-photo-url"
                           value="{{ old('user_photo_url', $serie->user_photo_url) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="published_at">Data de publicació</label>
                    <input type="datetime-local" name="published_at" id="published_at" data-qa="serie-published-at"
                           value="{{ old('published_at', $serie->published_at?->format('Y-m-d\TH:i')) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex gap-3">
                    <button type="submit" data-qa="serie-submit"
                            class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 text-sm font-medium">
                        Guardar canvis
                    </button>
                    <a href="{{ route('series.manage') }}"
                       class="bg-gray-100 text-gray-700 px-5 py-2 rounded hover:bg-gray-200 text-sm">
                        Cancel·lar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-videos-app-layout>
