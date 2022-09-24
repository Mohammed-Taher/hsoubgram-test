<x-app-layout>
    <div class="h-screen md:flex md:flex-row">
        {{-- Left Side --}}
        <div class="h-full md:w-7/12 bg-black flex items-center">
            <img class="max-h-screen object-cover mx-auto" src="/posts/{{ $post->image }}" alt="">
            <div class="contrast-125 brightness-125 mix-blend-overlay bg-gray-50 block absolute z-50"></div>
        </div>
        {{-- Right Side --}}
        <div class="flex flex-col w-full md:w-5/12 bg-white">
            {{-- Top --}}
            <div class="border-b border-b-2 ">
                <div class="flex items-center p-5">
                    <img class="w-10 h-10 mr-5 rounded-full" src="{{$post->owner->image}}" alt="">
                    <a class="font-bold" href="/{{$post->owner->username }}">{{$post->owner->username}}</a>
                    @if (auth()->id() !== $post->owner->id)
                        <form action="/toggle_follow" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$post->owner->id}}">
                            <button type="submit"
                                    class="ml-5 p-1 font-bold text-blue-500 text-sm">{{ auth()->user()->is_following($post->owner) ? "Unfollow" : "Follow" }}</button>
                        </form>
                    @endif
                </div>
            </div>
            {{-- Middle --}}
            <div class="grow overflow-y-auto">
                <div class="flex items-start p-5">
                    <img class="w-10 h-10 mr-5 rounded-full" src="{{$post->owner->image}}" alt="">
                    <div>
                        <a class="font-bold" href="{{$post->owner->username }}">{{$post->owner->username}}</a>
                        {{ $post->description }}
                    </div>
                </div>
                {{-- Comments --}}
                <div>
                    @foreach ($post->comments as $comment)
                        <div class="flex items-start px-5 py-2">
                            <img class="w-10 h-100 mr-5 rounded-full" src="{{$comment->owner->image}}" alt="">
                            <div class="flex flex-col">
                                <div>
                                    <a class="font-bold"
                                       href="/{{$comment->owner->username }}">{{$comment->owner->username}}</a>
                                    {{ $comment->body }}
                                </div>
                                <div class="mt-1 text-sm text-gray-400 font-bold">
                                    {{ $comment->created_at->diffForHumans(null, true, true) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- Likes and Actions --}}
            <div class="border-y border-y-2">
                <div class="flex flex-row p-4">
                    <livewire:like :post="$post"/>
                    <a class="grow" onclick="document.getElementById('comment_body').focus()">
                        <i class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer mr-3"></i>
                    </a>
                </div>
                <div class="px-5 mb-4">
                    @if ($users->count() > 0)
                        {{__('Liked By')}}
                        <strong> <a href="/{{ $users->first()->username }}">{{ $users->first()->username }}</a>
                        </strong>
                        @if ($users->count() > 1)
                            and <strong><a href="liked_by">others</a></strong>
                        @endif
                    @endif
                </div>
            </div>

            {{-- Add Comment --}}
            <div class="p-5">
                <form action="/p/{{$post->id}}/comment" method="post">
                    @csrf
                    <div class="flex flex-row">
                        <textarea
                            name="body"
                            id="comment_body"
                            placeholder="Add a comment..."
                            class="grow border-none resize-none focus:ring-0 outline-0 bg-none h-5 p-0 overflow-hidden placeholder-gray-400"></textarea>
                        <button type="submit" class="bg-white border-none text-blue-500 ml-5">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($post->owner->id != auth()->id())
        <div class="my-10 border-t border-t-2 ">
            <h3 class="text-gray-500 pt-5">{{_('More posts from')}}
                <a
                    class="text-black font-bold"
                    href="/{{$post->owner->username}}">{{ $post->owner->username }}
                </a>
            </h3>

            <div class="grid grid-cols-3 gap-1 md:gap-5 mt-8">
                @foreach ($more_posts as $post)
                    <div>
                        <a href="/p/{{ $post->slug }}">
                            <img class="w-full aspect-square object-cover" src="/posts/{{ $post->image }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-app-layout>
