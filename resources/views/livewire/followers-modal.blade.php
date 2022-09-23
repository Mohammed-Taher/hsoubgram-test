<div class="p-5">
    <h1 class="text-2xl text-center border-b border-b-2 border-b-neutral-100 p-2">{{__('Followers')}}</h1>
    @forelse ($followers_list as $follower)
        <ul class="overflow-y-scroll max-h-48">
            @livewire('users-list-item', ['userId' => $follower['id'], 'type' => 'followers'], key('user'.$follower['id']))
        </ul>
    @empty
        <div class="mt-5">
            {{ __('You are not followed by anyone.') }}
        </div>
    @endforelse
</div>
