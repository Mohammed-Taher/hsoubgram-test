<li class="flex flex-row w-full p-3 items-center text-sm">
    <div>
        <img src="{{$userImage}}"
             class="w-8 h-8 mr-2 rounded-full border border-neutral-300">
    </div>
    <div class="flex flex-col grow">
        <div class="font-bold">
            <a href="/{{ $userUsername }}">{{ $userUsername }}</a>
        </div>
        <div class="text-sm text-neutral-500">
            {{ $userName }}
        </div>
    </div>
    <div class="flex">

        @if($type == 'pending')
            @livewire('confirm-follow-request', ['user_id' => $userId])
            @livewire('delete-follow-request', ['user_id' => $userId])
        @elseif($type == 'following')

            <form action="{{url('toggle_follow')}}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{$userId}}">
                <button type="submit"
                        class="ml-5 p-1 font-bold text-blue-500 text-sm">{{ __("Unfollow") }}</button>
            </form>
        @elseif($type == 'followers')
            @livewire('delete-follow-request', ['user_id' => $userId])
        @endif
    </div>
</li>
