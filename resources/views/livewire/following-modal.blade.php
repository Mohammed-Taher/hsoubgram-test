<div class="p-5">
    <h1 class="text-2xl text-center border-b border-b-2 border-b-neutral-100 p-2">{{__('Following')}}</h1>
    @forelse (auth()->user()->following as $follower)
        <ul class="overflow-y-scroll max-h-48">
            @livewire('users-list-item', ['userId' => $follower->id, 'type' => 'following'], key('user'.$follower->id))
        </ul>
    @empty
        <div class="mt-5">
            {{ __('You are not following anyone.') }}
        </div>
    @endforelse
</div>
