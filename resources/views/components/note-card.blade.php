@props(['note'])
@php
    $date = new DateTime($note->created_at);
    $date->setTimezone(new DateTimeZone('Asia/Jakarta'));

@endphp

<!-- Card-->
<article class="mb-4 break-inside p-6 rounded-xl bg-white dark:bg-slate-800 bg-clip-border h-fit"
    data-note-id="{{ $note->id }}">
    <div class="flex pb-6 items-center justify-between">
        <div class="flex">
            <a class="inline-block mr-4" href="#">
                <img class="rounded-full max-w-none w-12 h-12" src="https://randomuser.me/api/portraits/men/35.jpg" />
            </a>
            <div class="flex flex-col">
                <div>
                    <a class="inline-block text-lg font-bold dark:text-white" href="#">{{ $note->user->name }}</a>
                </div>
                <div class="text-slate-500  dark:text-slate-400">
                    {{ $date->format('d M Y') }}
                </div>
            </div>
        </div>
    </div>

    <p class="dark:text-slate-200 truncate line-clamp-6 whitespace-normal max-w-full">
        {{ $note->content }}
    </p>
    <div class="py-4">
        <a class="flex items-center" href="javascript:void(0);">
            <span class="icon-[tabler--message] size-6 mr-2"></span>
            @php
                $comments = App\Models\NoteComment::where('note_id', $note->id)->count();
            @endphp
            <span class="text-lg font-bold mr-1">{{ $comments }}</span>
            <span class="text-sm text-slate-500 dark:text-slate-300">Comments</span>
        </a>
    </div>
    <div class="relative">
        <input
            class="pt-2 pb-2 pl-3 w-full h-11 bg-slate-100 dark:bg-slate-600 rounded-lg placeholder:text-slate-600 dark:placeholder:text-slate-300 font-medium pr-20"
            type="text" placeholder="Write a comment" />
        <span class="flex absolute right-3 top-2/4 -mt-3 items-center">

            <svg class="fill-blue-500 dark:fill-slate-50" style="width: 24px; height: 24px;" viewBox="0 0 24 24">
                <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"></path>
            </svg>
        </span>
    </div>
    <!-- Comments content -->
    <div class="pt-6 hidden">
        <!-- Comment row -->
        <div class="media flex pb-4">
            <a class="mr-4" href="#">
                <img class="rounded-full max-w-none w-12 h-12" src="https://randomuser.me/api/portraits/men/82.jpg" />
            </a>
            <div class="media-body">
                <div>
                    <a class="inline-block text-base font-bold mr-2" href="#">Leslie Alexander</a>
                    <span class="text-slate-500 dark:text-slate-300">25 minutes ago</span>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur.</p>
                <div class="mt-2 flex items-center">
                    <a class="inline-flex items-center py-2 mr-3" href="#">
                        <span class="mr-2">
                            <svg class="fill-rose-600 dark:fill-rose-400" style="width: 22px; height: 22px;"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z">
                                </path>
                            </svg>
                        </span>
                        <span class="text-base font-bold">12</span>
                    </a>
                    <button class="py-2 px-4 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg">
                        Repply
                    </button>
                </div>
            </div>
        </div>
        <!-- End comments row -->
        <!-- comments row -->
        <div class="media flex pb-4">
            <a class="inline-block mr-4" href="#">
                <img class="rounded-full max-w-none w-12 h-12" src="https://randomuser.me/api/portraits/women/76.jpg" />
            </a>
            <div class="media-body">
                <div>
                    <a class="inline-block text-base font-bold mr-2" href="#">Tina Mills</a>
                    <span class="text-slate-500 dark:text-slate-300">3 minutes ago</span>
                </div>
                <p>Dolor sit ameteiusmod consectetur adipiscing elit.</p>
                <div class="mt-2 flex items-center">
                    <a class="inline-flex items-center py-2 mr-3" href="#">
                        <span class="mr-2">
                            <svg class="fill-rose-600 dark:fill-rose-400" style="width: 22px; height: 22px;"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12.1 18.55L12 18.65L11.89 18.55C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5C9.04 5 10.54 6 11.07 7.36H12.93C13.46 6 14.96 5 16.5 5C18.5 5 20 6.5 20 8.5C20 11.39 16.86 14.24 12.1 18.55M16.5 3C14.76 3 13.09 3.81 12 5.08C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.41 2 8.5C2 12.27 5.4 15.36 10.55 20.03L12 21.35L13.45 20.03C18.6 15.36 22 12.27 22 8.5C22 5.41 19.58 3 16.5 3Z">
                                </path>
                            </svg>
                        </span>
                        <span class="text-base font-bold">0</span>
                    </a>
                    <button class="py-2 px-4 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg">
                        Repply
                    </button>
                </div>
            </div>
        </div>
        <!-- End comments row -->
        <!-- More comments -->
        <div class="w-full">
            <a href="#"
                class="py-3 px-4 w-full block bg-slate-100 dark:bg-slate-700 text-center rounded-lg font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition ease-in-out delay-75">Show
                more comments</a>
        </div>
        <!-- End More comments -->
    </div>
    <!-- End Comments content -->
</article>
