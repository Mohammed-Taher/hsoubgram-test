<x-app-layout>
    <form action="/{{$user->username}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{_('Profile')}}</h3>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="#" method="POST">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="username" class="block text-sm font-medium text-gray-700">
                                            {{_('Username')}} </label>
                                        <input type="text" name="username" id="company-website"
                                               class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 mt-1 block w-full rounded sm:text-sm border-gray-300"
                                               value="{{$user->username}}"
                                        >
                                        @error('username')
                                        <div class="mt-2 text-sm text-red-600"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="about"
                                           class="block text-sm font-medium text-gray-700"> {{_('Bio')}} </label>
                                    <div class="mt-1">
                                    <textarea id="bio" name="bio" rows="3"
                                              class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                    >{{ $user->bio }}</textarea>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700"> Photo </label>
                                    <div class="mt-1 flex items-center">
                                        <img src="{{ $user->image }}"
                                             class="h-12 w-12 rounded-full mr-5 border border-gray-300">
                                        <input
                                            class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-xl"
                                            name="image" id="file_input" type="file">
                                    </div>
                                    @error('image')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="private" name="private"
                                                   type="checkbox"
                                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                                {{ $user->private_account ? 'checked': '' }}
                                            >
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="private"
                                                   class="font-medium text-gray-700">{{_('Private Account')}}</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{_('Save')}}
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>

        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="name"
                                           class="block text-sm font-medium text-gray-700">{{_('Name')}}</label>
                                    <input type="text" name="name" id="name"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                           value="{{$user->name}}"
                                    >
                                    @error('name')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="email-address"
                                           class="block text-sm font-medium text-gray-700">{{_('Email address')}}</label>
                                    <input type="text" name="email" id="email" autocomplete="email"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                           value= {{ $user->email }}
                                    >
                                    @error('email')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="password"
                                           class="block text-sm font-medium text-gray-700">{{_('Password')}}</label>
                                    <input type="password" name="password" id="password"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    >
                                    @error('password')
                                    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-span-6 sm:col-span-4">
                                    <label for="password_confirmation"
                                           class="block text-sm font-medium text-gray-700">{{_('Password Confirmation')}}</label>
                                    <input type="password" name="password_confirmation"
                                           id="password_confirmation"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{_('Save')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-app-layout>
