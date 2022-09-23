<li class="flex flex-row w-full p-3 items-center text-sm">
    <div>
        <img src="{{$follower->image}}"
             class="w-8 h-8 mr-2 rounded-full border border-neutral-300">
    </div>
    <div class="flex flex-col grow">
        <div class="font-bold">
            <a href="/{{ $follower->username }}">{{ $follower->username }}</a>
        </div>
        <div class="text-sm text-neutral-500">
            {{ $follower->username }}
        </div>
    </div>
</li>
