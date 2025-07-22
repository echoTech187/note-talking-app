<div id="shareModal" role="dialog" aria-modal="true" aria-labelledby="dialog-title" class="relative z-10 hidden">

    <div aria-hidden="true" class="fixed inset-0 bg-gray-500/75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">

        <form action="javascript:void(0);" name="shareNoteFrm" id="shareNoteFrm" method="POST">
            @csrf
            <input type="hidden" name="noteId" id="noteId" value="">
            <div class="flex min-h-full items-end justify-center text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg lg:max-w-2xl">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                                <span class="icon-[tabler--share] size-6 text-indigo-600"></span>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900" id="dialog-title">
                                    Share Note
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2">
                        <select data-twe-select-init name="assignee" id="assignee"
                            class=" min-w-full w-fit border border-gray-200 text-sm text-gray-700 h-9 pt-2 px-4 pr-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            @php
                                $users = \App\Models\User::where('id', '!=', auth()->user()->id)->get();
                            @endphp
                            <option value="" disabled selected>Pilih Pengguna</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" class="flex">
                                    <span class=" w-6 h-6 text-gray-500 p-2 rounded-full"
                                        style="background: url('@if ($user->avatar != null && $user->avatar != '' && $user->avatar != 'undefined') {{ asset('storage/' . $user->avatar) }} @else {{ asset('images/No-image-available.png') }} @endif'); background-size: cover;"></span>
                                    <span>{{ $user->name }}</span>
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-4">
                        <button type="button" data-target="addNote" onclick="share()" class="button-red-pushable"
                            role="button">
                            <span class="button-red-shadow"></span>
                            <span class="button-red-edge"></span>
                            <span class="button-red-front text-sm text-light font-bold flex items-center">
                                <span class="icon-[tabler--circle-plus] size-6 mr-2"></span>
                                Bagikan
                            </span>
                        </button>
                        <button type="button" data-target="addNote" onclick="closeShareModal()"
                            class="button-secondary-pushable" role="button">
                            <span class="button-secondary-shadow"></span>
                            <span class="button-secondary-edge"></span>
                            <span class="button-secondary-front text-sm text-light font-bold flex items-center">
                                <span class="icon-[tabler--circle-x] size-6 mr-2"></span>
                                Batal
                            </span>
                        </button>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
