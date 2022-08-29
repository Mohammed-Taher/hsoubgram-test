<div class="card">
    <div class="card-header">
        <img src="{{ $post->owner->image }}" class="w-8 h-8 mr-5 rounded-full"/>
        <a href="/{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
        @if (auth()->id() !== $post->owner->id)
            <form action="{{url('toggle_follow')}}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{$post->owner->id}}">
                <button type="submit"
                        class="ml-5 p-1 font-bold text-blue-500 text-sm">{{ auth()->user()->is_following($post->owner) ? "Unfollow" : "Follow" }}</button>
            </form>
        @endif
    </div>
    <div class="card-body">
        <img class="aspect-square" src="/posts/{{ $post->image }}"/>
        <div class="flex flex-row p-4">
            <a href="/p/{{$post->slug}}/like">
                @if ($post->liked(auth()->user()))
                    <i class="bx bxs-heart text-red-600 text-3xl hover:text-gray-400 cursor-pointer mr-3"></i>
                @else
                    <i class="bx bx-heart text-3xl hover:text-gray-400 cursor-pointer mr-3"></i>
                @endif
            </a>
            <a class="grow" href="/p/{{$post->slug}}"><i
                    class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer mr-3"></i></a>
        </div>
        <div class="p-3 mt-3">
            <a class="font-bold mr-1"
               href="/{{$post->owner->id}}">{{$post->owner->username}}</a>
            {{ $post->description }}
        </div>
        @if ($post->comments()->count() > 0)
            <div class="p-3 mt-3">
                <a href="/p/{{$post->slug}}">View all {{ $post->comments()->count() }} comments</a>
            </div>
        @endif
        <div class="p-3 text-gray-400 uppercase text-xs">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </div>
    <div class="card-footer">
        <form action="/p/{{$post->id}}/comment" method="post">
            @csrf
            <div class="flex flex-row">
            <textarea name="body" placeholder="Add a comment..." autocomplete="off" autocorrect="off"
                      class="grow border-none resize-none focus:ring-0 outline-0 bg-none max-h-60 h-5 p-0 overflow-hidden placeholder-gray-400"></textarea>
                <button type="submit" class="bg-white border-none text-blue-500 ml-5">Post</button>
            </div>
        </form>
    </div>
</div>
