<x-app-layout>
    <div class="mx-auto mt-20">
        <div class="flex flex-row">
            <div class="w-32 h-32 mr-20">
                <img id="user_image" class="rounded-full" src="{{ $user->image }}"/>
            </div>
            <div class="flex flex-col">
                <div class="flex flex-row mb-10">
                    <span class="text-3xl mr-10">{{ $user->username }}</span>
                    @if ($user->id == auth()->id())
                        <a href="/{{$user->username}}/edit"
                           class="bg-gray-100 border border-gray-500 text-black px-3 py-1 rounded">Edit
                            Profile</a>
                    @else
                        <form action="{{url('toggle_follow')}}" method="post">
                            @csrf
                            <button type="submit"
                                    class="bg-blue-400 text-white px-3 py-1 rounded"
                            >{{ auth()->user()->is_following($user) ? "Unfollow" : "Follow" }}
                            </button>
                            @endif
                        </form>
                </div>
                <ul class="flex flex-row mb-10 justify-between text-lg">
                    <li> {{ $user->posts->count() }} {{ $user->posts->count() > 1 ? 'posts' : 'post' }}</li>
                    <li> {{ $user->followers->count() }} {{ $user->posts->count() > 1 ? 'followers' : 'follower' }}
                    </li>
                    <li> {{ $user->following->count() }} following</li>
                </ul>

                <div>
                    {{ $user->bio }}
                </div>
            </div>
        </div>

        <div class="mt-20">
            <h1 class="text-3xl mb-10">Posts</h1>
            <div class="grid grid-cols-3 gap-6">
                @foreach ($user->posts as $post)
                    <a class="aspect-square block w-full" href="/p/{{$post->slug}}">
                        <img class="w-full aspect-square object-cover" src="/posts/{{ $post->image }}">
                    </a>
                @endforeach
            </div>
        </div>
</x-app-layout>
