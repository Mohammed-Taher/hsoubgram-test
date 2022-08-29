<div class="border-2 border-gray-200">
    <div class="h-screen flex flex-row">
        {{-- Left Side --}}
        <div class="h-screen flex items-center bg-black w-8/12">
            <img wire:model="image" src="/temp/{{ $image }}" class="max-h-screen mx-auto object-cover">
        </div>

        {{-- Right Side --}}
        <div class="w-4/12 p-5 flex flex-col bg-white">
            <h3 class="text-2xl text-center mb-10">Filters</h3>
            <div class="grid grid-cols-3 gap-4">
                @foreach($filters as $filter)
                    <div class="flex flex-col">
                        <img
                            wire:click="{{'filter_' . strtolower($filter)}}"
                            class="mb-3 cursor-pointer hover:ring-1 hover:ring-gray-500"
                            src="/storage/{{$filter}}.jpg"
                            alt="">
                        <span class="text-center text-gray-500">{{$filter}}</span>
                    </div>
                @endforeach
            </div>
            <form class="w-full mt-auto" action="/p/filters" method="post" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded">Publish</button>
            </form>
        </div>
    </div>
</div>
