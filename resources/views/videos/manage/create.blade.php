<x-videos-app-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('videos.manage') }}" class="text-gray-400 hover:text-gray-600">
                ← Tornar
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Afegir vídeo</h1>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <form method="POST" action="{{ route('videos.manage.store') }}" data-qa="create-video-form">
                @csrf

                <!-- Títol -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        Títol <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        data-qa="input-title"
                        value="{{ old('title') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                        placeholder="Títol del vídeo"
                    >
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripció -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Descripció
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        data-qa="input-description"
                        rows="4"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Descripció del vídeo"
                    >{{ old('description') }}</textarea>
                </div>

                <!-- URL -->
                <div class="mb-6">
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-1">
                        URL del vídeo <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="url"
                        id="url"
                        name="url"
                        data-qa="input-url"
                        value="{{ old('url') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('url') border-red-500 @enderror"
                        placeholder="https://www.youtube.com/watch?v=..."
                    >
                    @error('url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('videos.manage') }}"
                       data-qa="cancel-btn"
                       class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                        Cancel·lar
                    </a>
                    <button
                        type="submit"
                        data-qa="submit-btn"
                        class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors font-medium">
                        Guardar vídeo
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-videos-app-layout>
