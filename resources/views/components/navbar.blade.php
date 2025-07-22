{{-- @auth('web') --}}
<div
    class="w-full flex items-center justify-between p-4 bg-white dark:bg-[#161615] dark:text-white border-b border-b-gray-300 dark:border-b-[#3E3E3A]">
    <a href="{{ route('dashboard') }}"><x-frontend.logo size="8"
            class="flex items-center justify-start gap-2 uppercase" text="Note Talking" textSize="lg" />
    </a>
    <div class="relative flex items-center justify-end gap-4">
        @auth
            <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName" onclick="dropDownAvatar(this)"
                class=" flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:me-0 focus:ring-0 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white"
                type="button">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 me-2 rounded-full"
                    src="@if (auth()->user()->avatar != null && auth()->user()->avatar != '' && auth()->user()->avatar != 'undefined') {{ asset('storage/' . auth()->user()->avatar) }} @else {{ asset('images/No-image-available.png') }} @endif"
                    alt="user photo">
                {{ auth()->user()->name }}
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="dropdownAvatarName"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-64 dark:bg-gray-700 dark:divide-gray-600 border border-gray-100"
                style="position: absolute; left: auto; top: 100%; right:0px; z-index: 10" aria-hidden="true">
                <div class="bg-red-600 px-4 py-3 text-sm text-white rounded-t-lg">
                    <a href="{{ route('user.profile') }}"
                        class="text-lg font-medium hover:underline">{{ auth()->user()->name }}</a>
                    <div class="truncate text-xs">{{ auth()->user()->email }}</div>
                </div>
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                    <li class="">
                        <a href="{{ route('dashboard') }}"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('user.profile') }}"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                    </li>
                </ul>
                <div class="py-2">
                    <a href="javascript:void(0)" onclick="window.location.href = `{{ route('logout') }}`"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Keluar</a>
                </div>
            </div>
        @endauth
    </div>
</div>
@if (Route::currentRouteName() == 'dashboard')
    <div
        class="w-full flex items-center justify-end py-4 px-6 bg-white dark:bg-[#161615] dark:text-white border-b border-b-gray-300 dark:border-b-[#3E3E3A]">
        <button type="button" data-target="addNote" onclick="addNote()" class="button-red-pushable" role="button">
            <span class="button-red-shadow"></span>
            <span class="button-red-edge"></span>
            <span class="button-red-front text-sm text-light font-bold flex items-center">
                <span class="icon-[tabler--circle-plus] size-6 mr-2"></span>
                Buat Catatan Baru
            </span>
        </button>
        <x-add-note-modal />
    </div>
@endif
