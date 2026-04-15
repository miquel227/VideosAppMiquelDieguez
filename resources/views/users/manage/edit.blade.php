<x-videos-app-layout>
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('users.manage') }}" class="text-gray-400 hover:text-gray-600">
                ← Tornar
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Editar usuari</h1>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <form method="POST" action="{{ route('users.manage.update', $user) }}" data-qa="edit-user-form">
                @csrf
                @method('PUT')

                <!-- Nom -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nom <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        data-qa="input-name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                    >
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        data-qa="input-email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contrasenya (opcional) -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Nova contrasenya <span class="text-gray-400 text-xs">(deixa en blanc per no canviar-la)</span>
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        data-qa="input-password"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('users.manage') }}"
                       data-qa="cancel-btn"
                       class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                        Cancel·lar
                    </a>
                    <button
                        type="submit"
                        data-qa="submit-btn"
                        class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors font-medium">
                        Actualitzar usuari
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-videos-app-layout>
