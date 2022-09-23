<div>
    <x-dropdown align="bottom" width="64" trigger_type="keydown">
        <x-slot name="trigger">
            <input type="text" name="search" wire:model="searchInput"
                   wire:keydown="search({{$searchInput}})"
                   class="w-56 lg:w-72 border-none bg-gray-100 rounded-xl h-10 focus:ring-0"
                   placeholder="{{__('Search..')}}"
                   autocomplete="off"
            />
        </x-slot>

        <x-slot name="content" class="overflow-y-auto max-h-48">
            @if ($results)
                @foreach ($results as $user)
                    <ul>
                        @livewire('users-list-item', ['userId' => $user['id'], 'type' => 'search'], key('user'.$user['id']))
                    </ul>
                @endforeach
            @else
                <div class="p-4 ">{{ __('No results found.') }}</div>
            @endif
        </x-slot>
    </x-dropdown>
</div>
