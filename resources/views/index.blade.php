@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

    @php
        $loggedInUserId = auth()->user()->id;
        $notes = \App\Models\Note::where('visibility', 'public')
            ->with([
                'user',
                'comments' => function ($query) {
                    $query
                        ->where('note_comments.comment_parent_id', null)
                        ->with('user')
                        ->with('replies', function ($subQuery) {
                            $subQuery->where('note_comments.comment_parent_id', '!=', null)->with('user');
                        });
                },
            ])
            // ->with('comments_all')
            ->withCount('comments')
            ->orWhere(function ($query) use ($loggedInUserId) {
                $query->where('notes.visibility', 'private')->where('notes.user_id', $loggedInUserId); // Catatan pribadi milik user yang login
            })
            ->orWhere(function ($query) use ($loggedInUserId) {
                $query->where('notes.visibility', 'shared')->where(function ($subQuery) use ($loggedInUserId) {
                    $subQuery
                        ->where('notes.user_id', $loggedInUserId) // Catatan yang dibuat oleh user yang login
                        ->orWhereIn('notes.id', function ($innerSubQuery) use ($loggedInUserId) {
                            $innerSubQuery
                                ->select('ps.note_id')
                                ->from('note_permissions AS ps')
                                ->where('ps.shared_with_user_id', $loggedInUserId); // Catatan yang di-share ke user yang login
                        });
                });
            })
            ->groupBy('notes.id')
            ->orderByDesc('notes.created_at')
            ->get();

        $json = [];
        foreach ($notes as $note) {
            array_push($json, $note);
        }
    @endphp
    @if (count($notes) == 0)
        <div class="flex flex-col items-center justify-center text-center min-h-full w-full flex-1 ">
            <span class="icon-[tabler--folder-off] size-24 mb-6 text-gray-400"></span>
            <h1 class="text-2xl font-bold text-gray-700 mb-4">Halo, {{ auth()->user()->name }}</h1>
            <p class="text-gray-400">Sepertinya kamu belum memiliki catatan yang terhubung.</p>
            <p class="text-gray-400 mb-10">
                Buat catatan baru sekarang!
            </p>
            <button type="button" data-target="addNote" onclick="addNote()" class="button-red-pushable" role="button">
                <span class="button-red-shadow"></span>
                <span class="button-red-edge"></span>
                <span class="button-red-front text-sm text-light font-bold flex items-center">
                    <span class="icon-[tabler--circle-plus] size-6 mr-2"></span>
                    Buat Catatan Baru
                </span>
            </button>

        </div>
    @else
        <div class="p-6 bg-gray-100 flex-1">
            <div class="masonry-container" id="note-container">
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        var json = @php echo json_encode($json); @endphp;
        var userId = @php echo auth()->user()->id; @endphp;
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            tinymce.init({
                selector: 'textarea#note',
                license_key: '{{ env('TINYMCE_KEY') }}',
                toolbar_location: 'bottom',
                plugins: 'lists table link image code fullscreen',
                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | table',
                menubar: false,
                statusbar: false
            });
            noteCards(json, userId);


        })
        $(window).resize(function() {
            noteCards(json, userId);
        })

        function postNote() {
            var note = tinymce.get("note").getContent();

            const formData = {
                note: note,
                visibility: $('#visibility').val(),
                assignee: $('#assignee').val(),
                _token: '{{ csrf_token() }}'
            }

            $.ajax({
                url: "{{ route('notes.store') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.responseStatus) {
                        toastr.success(response.responseMessage);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);

                    } else {
                        toastr.error(response.responseMessage);
                    }
                }
            });
        }

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
    </script>
@endsection
