<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">
        {{--Left Side--}}
        <div class="w-[30rem] mx-auto lg:w-[95rem]">
            @forelse ($posts as $post)
                <x-post :post=$post/>
                    @empty
                        <div class="max-w-2xl gap-8 mx-auto">
                            {{ __('Start following your friends and enjoy.') }}
                        </div>
            @endforelse
        </div>

        {{--Right Side--}}
        <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4">
            {{-- User avatar and name --}}
            <div class="flex flex-row text-sm">
                <div class="mr-5">
                    <a href="/{{ auth()->user()->username }}">
                        <img src="{{ auth()->user()->image }}"
                             class="border border-gray-300 rounded-full h-12 w-12">
                    </a>
                </div>
                <div class="flex flex-col">
                    <div class="font-bold">
                        <a href="/{{ auth()->user()->username }}">
                            {{ auth()->user()->username }}
                        </a>
                    </div>
                    <div class="text-gray-500 text-sm">{{ auth()->user()->name }}</div>
                </div>
            </div>

            {{--Suggested Users--}}
            <div class="mt-10">
                <h3 class="text-gray-500 font-bold">Suggestions For You</h3>
                <ul>
                    @foreach ($suggestedUsers as $suggestedUser)
                        <li class="flex flex-row my-3 text-sm">
                            <div class="mr-5">
                                <a href="/{{ $suggestedUser->username }}">
                                    <img src="{{ $suggestedUser->image }}"
                                         class="rounded-full h-8 w-8 border border-gray-300">
                                </a>
                            </div>

                            <div class="flex flex-col grow">
                                <div class="font-bold">
                                    <a href="/{{ $suggestedUser->username }}">
                                        {{ $suggestedUser->username }}
                                    </a>
                                    @if (auth()->user()->is_follower($suggestedUser))
                                        <span class="text-xs text-gray-500">Follower</span>
                                    @endif
                                </div>
                                <div class="text-gray-500 text-sm">{{ $suggestedUser->name }}</div>
                            </div>

                            <div>
                                @if (auth()->user()->is_a_pending_following($suggestedUser))
                                    <span class="font-bold text-gray-500">Pending</span>
                                @else
                                    <form action="/toggle_follow" method="post">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$suggestedUser->id}}">
                                        <button type="submit"
                                                class="ml-5 p-1 font-bold text-blue-500">
                                            Follow
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>

