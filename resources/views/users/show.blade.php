<x-videos-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('users.index') }}" class="text-gray-400 hover:text-gray-600">
                ← Tornar
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Perfil de l'usuari</h1>
        </div>

        <!-- Informació de l'usuari -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xl flex-shrink-0">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h2>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                <p class="text-xs text-gray-400 mt-1">Membre des de {{ $user->created_at->locale('ca')->isoFormat('D [de] MMMM [de] YYYY') }}</p>
            </div>
        </div>

        <!-- Vídeos de l'usuari -->
        <h3 class="text-lg font-semibold text-gray-900 mb-4">
            Vídeos publicats ({{ $videos->count() }})
        </h3>

        @if ($videos->isEmpty())
            <p class="text-gray-500">Aquest usuari no ha publicat cap vídeo.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($videos as $video)
                    <a href="{{ route('videos.show', $video) }}"
                       class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="aspect-video bg-gray-100 flex items-center justify-center text-gray-400 text-xs">
                            @php
                                preg_match('/(?:v=|youtu\.be\/)([A-Za-z0-9_\-]{11})/', $video->url, $m);
                                $videoId = $m[1] ?? null;
                            @endphp
                            @if ($videoId)
                                <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg"
                                     alt="{{ $video->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <span>Sense miniatura</span>
                            @endif
                        </div>
                        <div class="p-3">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $video->title }}</p>
                            <p class="text-xs text-gray-500">{{ $video->formatted_published_at ?? '—' }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

    </div>
</x-videos-app-layout>
