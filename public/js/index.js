function noteCards(json, userId) {


    let countColumn = 0;
    if (window.innerWidth < 640) {
        countColumn = 1;
    }
    if (window.innerWidth >= 640 && window.innerWidth < 1024) {
        countColumn = 1;
    }
    if (window.innerWidth >= 1024 && window.innerWidth < 1280) {
        countColumn = 2;
    }
    if (window.innerWidth >= 1280) {
        countColumn = 2;
    }
    const noteContainer = $('#note-container');
    noteContainer.empty();
    noteContainer.css('column-count', countColumn);
    for (let i = 0; i < json.length; i++) {
        noteContainer.append(createNoteCard(json[i]));
    }
}

function showMore(noteId) {
    window.location.href = '/note/' + noteId;
}

function createNoteCard(note) {
    const data = new Date(note.created_at);
    const date = new Date(data);

    let comments = note.comments;


    // let noteCard = '';
    let noteContainer = $('<article></article>', {
        class: 'note-card',
        id: 'note_card_' + note.id,
        'data-note-id': note.id,
    });

    var noteHeader = $('<div></div>', {
        class: 'flex pb-6 items-center justify-between',
    });
    noteHeader.append($('<div></div>', {
        class: 'flex justify-between',
    }).append($('<a></a>', {
        class: 'inline-block mr-4',
        href: '#',
    }).append($('<img></img>', {
        class: 'rounded-full max-w-none w-12 h-12',
        src: (note.user.avatar) ? '/storage/' + note.user.avatar : '/images/No-image-available.png',
    }))).append($('<div></div>', {
        class: 'flex flex-col',
    }).append($('<a></a>', {
        class: 'inline-block text-lg font-bold dark:text-white',
        href: '#',
    }).text(note.user.name)).append($('<div></div>', {
        class: 'text-slate-500 text-sm dark:text-slate-400 flex items-center',
    }).html(date.toLocaleString("id-ID", {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
    })).prepend((note.visibility == 'public') ? '<span class="icon-[tabler--world] size-4 mr-2 text-gray-400"></span>' : (note.visibility == 'private') ? '<span class="icon-[tabler--lock] size-4 mr-2 text-gray-400"></span>' : '<span class="icon-[tabler--user] size-4 mr-2 text-gray-400"></span>'))));

    noteContainer.append(noteHeader);
    var anchor_1 = $('<a></a>', {
        class: 'inline-block',
        href: '#',
    });
    noteHeader.append(anchor_1);


    noteContainer.append($('<div></div>', {
        class: 'dark:text-slate-200 truncate line-clamp-6 whitespace-normal max-w-full cursor-pointer post',
        id: 'post_' + note.id,
        onclick: "showNote('" + note.slug + "')",

    }).html(note.content));



    var noteFooter = $('<div></div>', {
        class: 'py-4',
    });
    noteFooter.append($('<a></a>', {
        class: 'flex items-center h-6 mb-3',
        href: 'javascript:void(0);'
    }).attr('onclick', 'showNote(\'' + note.slug + '\')').append($('<span></span>', {
        class: 'icon-[tabler--message] size-5 mr-2',
    })).append($('<span></span>', {
        class: 'text-lg font-bold mr-1',
        text: note.comments_count,
    })).append($('<span></span>', {
        class: 'text-sm text-slate-500 dark:text-slate-300',
        text: 'Comments',
    })));

    noteContainer.append(noteFooter);
    return noteContainer;
}

function replyComment(noteId, commentId) {
    $('#comment_' + noteId).val(commentId);
}



function changeVisibility(e) {
    if (e.value == 'shared') {
        $("#assignee").toggleClass('hidden');
    } else {
        $("#assignee").addClass('hidden');
    }
}

function addNote() {
    $('#addNote').toggleClass('hidden');
}
function shareNote(noteId) {
    $('#noteId').val(noteId);
    $('#shareModal').toggleClass('hidden');
}

function showNote(id) {
    location.href = '/note/' + id;
}


function closeAddNote() {
    $('#addNote').toggleClass('hidden');
}
function closeShareModal() {
    $('#shareModal').toggleClass('hidden');
}

function dropDownAvatar(e) {
    var target = $(e).data("dropdown-toggle");
    $("#" + target).toggleClass("hidden");
    $("#" + target).toggleClass("block");
}