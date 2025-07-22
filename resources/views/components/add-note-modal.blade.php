<div id="addNote" role="dialog" aria-modal="true" aria-labelledby="dialog-title" class="relative z-10 hidden">

    <div aria-hidden="true" class="fixed inset-0 bg-gray-500/75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <form action="javascript:void(0);" name="addNoteFrm" id="addNoteFrm" method="POST">
            @csrf
            <div class="flex min-h-full items-end justify-center text-center sm:items-center sm:p-0">

                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg lg:max-w-2xl">
                    <div class="">
                        <textarea class="w-full text-sm p-4 focus-visible:outline-none" placeholder="Tulis sesuatu..." name="note"
                            id="note" cols="30" rows="10"></textarea>
                        <div class="px-4 py-2">
                            <div class="flex items-center justify-start gap-4">
                                <select data-twe-select-init name="visibility" id="visibility"
                                    onchange="changeVisibility(this)"
                                    class="min-w-[150px] w-fit border border-gray-200 text-sm text-gray-700 pt-2 h-9 px-4 pr-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="public" selected>
                                        <span class="icon-[tabler--globe] size-4 text-gray-500 px-2"></span>
                                        <span>Public</span>
                                    </option>
                                    <option value="shared" class="flex">
                                        <span class="icon-[tabler--share] size-4 text-gray-500 px-2"></span>
                                        <span>Bagikan ke</span>
                                    </option>
                                    <option value="private" class="flex" checked>
                                        <span class="icon-[tabler--lock] size-4 text-gray-500 px-2"></span>
                                        <span>Private</span>
                                    </option>

                                </select>
                                <select data-twe-select-init name="assignee" id="assignee"
                                    class="hidden min-w-[200px] w-fit border border-gray-200 text-sm text-gray-700 h-9 pt-2 px-4 pr-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    @php
                                        $users = \App\Models\User::where('id', '!=', auth()->user()->id)->get();
                                    @endphp
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" class="flex">
                                            <span class=" w-6 h-6 text-gray-500 p-2 rounded-full"
                                                style="background: url('{{ asset('images/avatar-' . $user->id . '.png') }}'); background-size: cover;"></span>
                                            <span>{{ $user->name }}</span>
                                        </option>
                                    @endforeach

                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-4">
                        <button type="button" data-target="addNote" onclick="postNote()" class="button-red-pushable"
                            role="button">
                            <span class="button-red-shadow"></span>
                            <span class="button-red-edge"></span>
                            <span class="button-red-front text-sm text-light font-bold flex items-center">
                                <span class="icon-[tabler--circle-plus] size-6 mr-2"></span>
                                Buat Catatan Baru
                            </span>
                        </button>
                        <button type="button" data-target="addNote" onclick="closeAddNote()"
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
