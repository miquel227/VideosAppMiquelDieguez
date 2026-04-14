<x-videos-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">

        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $video->title }}</h1>

        @if($video->published_at)
            <p class="text-sm text-gray-500 mb-4">
                Publicat el {{ $video->formatted_published_at }}
                &middot; {{ $video->formatted_for_humans_published_at }}
            </p>
        @endif

        <div class="aspect-video w-full mb-6">
            <iframe
                class="w-full h-full rounded-lg shadow"
                src="{{ str_replace('watch?v=', 'embed/', $video->url) }}"
                allowfullscreen>
            </iframe>
        </div>

        @if($video->description)
            <p class="text-gray-700 leading-relaxed">{{ $video->description }}</p>
        @endif

    </div>
</x-videos-app-layout>
