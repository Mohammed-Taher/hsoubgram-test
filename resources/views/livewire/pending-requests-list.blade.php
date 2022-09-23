<ul>
    @forelse ($pending_users_list as $user)
        @livewire('users-list-item', ['userId' => $user->id, 'type' => 'pending'], key('user'.$user->id))
    @empty
        <div class="p-3">
            {{ __('No Pending Requests') }}
        </div>
    @endforelse
</ul>
