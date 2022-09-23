<div>
    <button
        wire:model="confirm-follow-request"
        wire:click="delete({{$user_id}})"
        class="text-sm text-neutral-800 border border-neutral-500 text-white px-2 py-1 mr-1 rounded">
        {{ _('Delete') }}
    </button>
</div>
