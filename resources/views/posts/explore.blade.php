<x-app-layout>
    <div class="grid grid-cols-3 gap-1 md:gap-5 mt-8">
        @foreach ($posts as $post)
            <div>
                <a href="/p/{{ $post->slug }}">
                    <img class="w-full aspect-square object-cover" src="/posts/{{ $post->image }}">
                </a>
            </div>
        @endforeach
    </div>

</x-app-layout>
