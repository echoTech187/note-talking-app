@extends('layouts.app')
@section('title', 'Profile - {{ Auth::user()->name }}')
@section('content')
    @php
        $user = Auth::user();
    @endphp
    @auth
        <form action="{{ route('profile.update') }}" name="profileUpdateFrm" id="profileUpdateFrm" method="POST">
            @csrf
            <div class="flex item-center justify-center w-full min-h-[90%] bg-white">
                <div class="w-1/3">
                    <div class="flex flex-col items-center justify-center w-full h-[90%] relative my-auto">
                        <span
                            class="xs:relative sm:relative md:absolute lg:absolute z-0 top-0 text-sm text-gray-500 dark:text-gray-400 h-full">
                            <div class="relative h-full flex items-center">
                                <button type="button" id="upload-button"
                                    class="w-fit h-fit z-50 px-4 py-2 absolute m-auto inset-0 flex items-center justify-center gap-2 text-xs font-semibold text-white bg-[rgba(0,0,0,0.3)] rounded-full ">
                                    <span class="icon-[tabler--upload] size-4 font-bold"></span>

                                    Upload Avatar
                                </button>
                                <input type="file" name="avatar" id="avatar"
                                    class="z-1 hidden text-gray-700 mx-auto dark:text-gray-200 file:ml-0 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                    accept="image/*">
                                <img src="@if ($user->avatar != null && $user->avatar != '' && $user->avatar != 'undefined') {{ asset('storage/' . $user->avatar) }} @else {{ asset('images/No-image-available.png') }} @endif"
                                    id="userAvatar" alt="avatar"
                                    class="rounded-full border border-blue-400 w-[250px] h-[250px] mx-auto object-cover bg-gray-100" />
                            </div>
                        </span>


                    </div>
                    @error('avatar')
                        <span class="text-red-600 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full p-6 bg-white min-h-full">
                    <x-frontend.input name="name" type="text" placeholder="Name" value="{{ Auth::user()->name }}"
                        label="Name" />
                    <x-frontend.input name="email" type="email" placeholder="Email" value="{{ Auth::user()->email }}"
                        label="Email" />
                    <x-frontend.input name="password" type="password" placeholder="Password" label="Password" value="" />
                    <x-frontend.button type="submit" id="updateProfile">Update</x-frontend.button>
                </div>
            </div>
        </form>
    @else
        <div class="w-full">
            no auth
        </div>
    @endauth
@endsection
@section('scripts')
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection
