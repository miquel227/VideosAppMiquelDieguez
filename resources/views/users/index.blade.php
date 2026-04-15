<x-videos-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <h1 class="text-2xl font-bold text-gray-900 mb-6">Usuaris</h1>

        <!-- Cercador -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-6">
            <div class="flex gap-2">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cerca per nom o email..."
                    class="flex-1 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                    Cercar
                </button>
                @if ($search)
                    <a href="{{ route('users.index') }}"
                       class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                        Netejar
                    </a>
                @endif
            </div>
        </form>

        <!-- Llistat d'usuaris -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($users as $user)
                <a href="{{ route('users.show', $user) }}"
                   class="bg-white rounded-lg shadow-sm p-4 flex items-center gap-3 hover:shadow-md transition-shadow">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-sm">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                    </div>
                </a>
            @empty
                <p class="text-gray-500 col-span-3">No s'han trobat usuaris.</p>
            @endforelse
        </div>

    </div>
</x-videos-app-layout>
