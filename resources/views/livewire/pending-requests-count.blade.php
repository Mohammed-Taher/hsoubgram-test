<div>
    @if (auth()->user()->pendingFollowers()->count() > 0)
        <span
            class="bg-red-500 text-white rounded-full text-xs absolute w-5 h-5 p-0.5 text-center bottom-3 left-4">
                {{auth()->user()->pendingFollowers()->count()}}
            </span>
    @endif
</div>
