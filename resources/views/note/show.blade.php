@extends('layouts.app')
@section('title', 'Detail Note')
@section('content')
    @php

        $date = new DateTime($note->created_at);
        $date->setTimezone(new DateTimeZone('Asia/Jakarta'));
    @endphp
    <div class="bg-white w-full">
        <article class="note-card  max-w-3xl mx-auto">

            <div class="flex pb-6 items-center justify-between">
                <div class="flex justify-between">
                    <a class="inline-block mr-4" href="#">
                        <img class="rounded-full max-w-none w-12 h-12"
                            src="@if ($note->user->avatar) {{ asset('storage/' . $note->user->avatar) }} @else {{ asset('images/No-image-available.png') }} @endif" />
                    </a>
                    <div class="flex flex-col">
                        <a class="inline-block text-lg font-bold dark:text-white" href="#"> {{ $note->user->name }}
                        </a>
                        <div class="text-slate-500 text-sm  dark:text-slate-400 flex items-center">
                            @if ($note->visibility == 'private')
                                <span class="icon-[tabler--lock] size-4 mr-2"></span>
                            @elseif ($note->visibility == 'public')
                                <span class="icon-[tabler--world] size-4 mr-2"></span>
                            @elseif ($note->visibility == 'shared')
                                <span class="icon-[tabler--user] size-4 mr-2"></span>
                            @endif
                            {{ $date->format('d M Y') }}
                        </div>
                    </div>
                </div>
                @if ($note->user->id == Auth::user()->id)
                    <div class=" relative">
                        <a class="inline-block" href="javascript:void(0);" data-dropdown-toggle="dropdownDots"
                            id="dropdownMenuIconButton">
                            <span class="icon-[tabler--dots-vertical] size-6 text-slate-500"></span>
                        </a>
                        <div id="dropdownDots"
                            class="z-10 border border-gray-300 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600"
                            style="position: absolute; left: auto; top: 100%; right:0px; z-index: 10">
                            <ul class=" text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                @if ($note->visibility != 'shared')
                                    <li>
                                        <a href="javascript:void(0)" onclick="shareNote({{ $note->id }})"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><span
                                                class="icon-[tabler--user] size-4 mr-2"></span> Bagikan</a>
                                    </li>
                                @endif
                                @if ($note->visibility != 'private')
                                    <li>
                                        <a href="javascript:void(0)" onclick="update({{ $note->id }},'private')"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><span
                                                class="icon-[tabler--lock] size-4 mr-2"></span> Jadikan Private</a>
                                    </li>
                                @endif
                                @if ($note->visibility != 'public')
                                    <li>
                                        <a href="javascript:void(0)" onclick="update({{ $note->id }},'public')"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><span
                                                class="icon-[tabler--world] size-4 mr-2"></span> Jadikan
                                            Publik</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="javascript:void(0)" onclick="destroy({{ $note->id }})"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><span
                                            class="icon-[tabler--trash] size-4 mr-2"></span> Hapus</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <x-share-note-modal />
                @endif
            </div>
            <div class="dark:text-slate-200 max-w-full post" id="post">{!! $note->content !!} </div>

            <div class="py-4">
                <span class="flex items-center h-6" href="javascript:void(0)" disabled>
                    <span class="icon-[tabler--message] size-4 mr-2 text-slate-500"></span>
                    <span class="text-sm font-bold mr-1"> {{ $note->comments_count }}</span>
                    <span class="text-sm text-slate-500 dark:text-slate-300">Comments</span>
                </span>
            </div>
            <div class="pt-3">
                @if ($note->comments_count > 0)
                    @foreach ($note->comments as $comment)
                        @php
                            $commentDate = new DateTime($comment->created_at);
                            $commentDate->setTimezone(new DateTimeZone('Asia/Jakarta'));
                        @endphp
                        <div class="media flex pb-4">
                            <a class="mr-4" href="#">
                                <img class="rounded-full max-w-none w-8 h-8"
                                    src="@if ($comment->user->avatar) {{ asset('storage/' . $comment->user->avatar) }} @else {{ asset('images/No-image-available.png') }} @endif" />
                            </a>
                            <div class="media-body">
                                <div class="flex flex-col">
                                    <a class="inline-block text-base font-bold mr-2" href="#">
                                        {{ $comment->user->name }}
                                    </a>
                                    <span class="text-slate-500 dark:text-slate-300 text-xs">
                                        {{ $commentDate->format('d M Y') }}
                                    </span>
                                </div>
                                <p class="py-2">{{ $comment->comment }} </p>
                                <div class=" flex items-center">
                                    <a href="javascript:void(0)"
                                        onclick="replyComment({{ $note->id }},{{ $comment->id }})"
                                        class="text-sm text-slate-500 font-normal">Reply</a>
                                </div>
                                @if (count($comment->replies) > 0)
                                    @foreach ($comment->replies as $replay)
                                        @php
                                            $replyDate = new DateTime($replay->created_at);
                                            $replyDate->setTimezone(new DateTimeZone('Asia/Jakarta'));
                                        @endphp
                                        <div class="media flex mt-4">
                                            <a class="mr-4" href="#">
                                                <img class="rounded-full max-w-none w-8 h-8"
                                                    src="@if ($replay->user->avatar) {{ asset('storage/' . $replay->user->avatar) }} @else {{ asset('images/No-image-available.png') }} @endif" />
                                            </a>
                                            <div class="media-body">
                                                <div class="flex flex-col">
                                                    <a class="inline-block text-base font-bold mr-2" href="#">
                                                        {{ $replay->user->name }} </a>
                                                    <span class="text-slate-500 dark:text-slate-300 text-xs">
                                                        {{ $replyDate->format('d M Y') }}
                                                    </span>
                                                </div>
                                                <p class="py-2"> {{ $replay->comment }} </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif



            </div>
            <div class="relative">
                <form action="javascript:void(0)" name="commentFrm" id="commentFrm" method="POST">
                    @csrf
                    <input type="hidden" class="hidden" name="comment_id" id="comment_{{ $note->id }}"
                        value="" />
                    <input id="note_comment_{{ $note->id }}" name="note_comment"
                        class="pt-2 pb-2 pl-3 w-full h-11 bg-slate-100 dark:bg-slate-600 rounded-lg text-sm placeholder:text-sm placeholder:text-gray-500 dark:placeholder:text-slate-300 placeholder:font-medium pr-20"
                        type="text" placeholder="Tulis Komentar..." />
                    <a href="javascript:void(0)" onclick="postComment(this,  {{ $note->id }})"
                        class="flex absolute right-3 top-2/4 -mt-3 items-center w-6 h-6">
                        <svg class="fill-blue-500 dark:fill-slate-50" style="width: 24px height: 24px" viewBox="0 0 24 24">
                            <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"></path>
                        </svg>
                    </a>
                </form>
            </div>
        </article>
    </div>
@endsection
@section('scripts')
    <script>
        function postComment(e, noteId) {
            const action = $('#comment_' + noteId).data('action');
            const commentId = $('#comment_' + noteId).val();
            const note = $('#note_comment_' + noteId).val();
            const formData = {
                'note_id': noteId,
                'comment': note,
                'comment_id': commentId,
                '_token': '{{ csrf_token() }}'
            }
            $.ajax({
                url: "{{ route('note-comments.store') }}",
                type: "POST",
                data: {
                    note_id: noteId,
                    comment: note,
                    comment_id: commentId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "json",
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.responseStatus) {
                        location.reload();
                    } else {
                        alert(response.responseMessage);
                    }
                }
            });

        }
        $("#dropdownMenuIconButton").on("click", function() {
            var target = $(this).data("dropdown-toggle");
            $("#" + target).toggleClass("hidden");
        });

        function share() {
            const noteId = $('#noteId').val();
            const user_assigned = $('#assignee').val();
            const formData = {
                'visibility': 'shared',
                'shared_to': user_assigned,
                '_token': '{{ csrf_token() }}'
            }

            $.ajax({
                url: "{{ route('note.shared', 0) }}".replace('/0', '/' + noteId),
                type: "PUT",
                data: formData,
                dataType: "json",
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.responseStatus) {
                        toastr.success(response.responseMessage);
                        location.reload();
                    } else {
                        toastr.error(response.responseMessage);
                    }
                }
            });
        }

        function update(noteId, visibility) {
            var url = '';
            if (visibility == 'public') {
                url = "{{ route('note.public', 0) }}".replace('/0', '/' + noteId)
            } else if (visibility == 'private') {
                url = "{{ route('note.private', 0) }}".replace('/0', '/' + noteId)
            }

            const formData = {
                'visibility': visibility,
                '_token': '{{ csrf_token() }}'
            }

            $.ajax({
                url: url,
                type: "PUT",
                data: formData,
                dataType: "json",
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.responseStatus) {
                        toastr.success(response.responseMessage);
                        location.reload();
                    } else {
                        toastr.error(response.responseMessage);
                    }
                }
            });
        }

        function destroy(noteId) {
            const formData = {
                '_token': '{{ csrf_token() }}'
            }

            $.ajax({
                url: "{{ route('notes.destroy', 0) }}".replace('/0', '/' + noteId),
                type: "DELETE",
                data: formData,
                dataType: "json",
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.responseStatus) {
                        toastr.success(response.responseMessage);
                        location.href = '/';
                    } else {
                        toastr.error(response.responseMessage);
                    }
                }
            })
        }
    </script>
@endsection
