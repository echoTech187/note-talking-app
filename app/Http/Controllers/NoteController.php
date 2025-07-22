<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\NotePermission;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUserId = auth('web')->user()->id;

        $notes = Note::where('visibility', 'public')->with([
            'user',
            'comments' => function ($query) use ($loggedInUserId) {
                $query->where('visibility', 'public')
                    ->orWhere(function ($subQuery) use ($loggedInUserId) {
                        $subQuery->where('visibility', 'shared')
                            ->where(function ($innerSubQuery) use ($loggedInUserId) {
                                $innerSubQuery->where('user_id', $loggedInUserId)
                                    ->orWhereIn('post_id', function ($innerInnerSubQuery) use ($loggedInUserId) {
                                        $innerInnerSubQuery->select('post_id')
                                            ->from('note_permissions')
                                            ->where('shared_with_user_id', $loggedInUserId);
                                    });
                            });
                    });
            }
        ])->orWhere(function ($query) use ($loggedInUserId) {
            $query->where('p.visibility', 'private')
                ->where('p.user_id', $loggedInUserId); // Catatan pribadi milik user yang login
        })->orWhere(function ($query) use ($loggedInUserId) {
            $query->where('p.visibility', 'shared')
                ->where(function ($subQuery) use ($loggedInUserId) {
                    $subQuery->where('p.user_id', $loggedInUserId) // Catatan yang dibuat oleh user yang login
                        ->orWhereIn('p.post_id', function ($innerSubQuery) use ($loggedInUserId) {
                            $innerSubQuery->select('ps.post_id')
                                ->from('note_permissions AS ps')
                                ->where('ps.shared_with_user_id', $loggedInUserId); // Catatan yang di-share ke user yang login
                        });
                });
        })
            ->groupBy('p.post_id')
            ->orderByDesc('p.created_at');
        return response()->json(['responseCode' => 200, 'responseStatus' => true, 'data' => $notes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'note' => 'required',
            'visibility' => 'required|in:public,private,shared',
        ]);

        if ($validate->fails()) {
            foreach ($validate->errors()->all() as $error) {
                return response()->json(['responseCode' => 401, 'responseStatus' => false, 'responseMessage' => $error]);
            }
        }

        $data = [
            'slug' => \Illuminate\Support\Str::uuid()->toString(),
            'content' => $request->note,
            'visibility' => $request->visibility,
            'user_id' => auth('web')->user()->id,
        ];

        $save = Note::create($data);
        if ($save) {
            if ($request->visibility == 'shared') {
                $validate = Validator::make($request->all(), [
                    'assignee' => 'required',
                ]);

                if ($validate->fails()) {
                    foreach ($validate->errors()->all() as $error) {
                        return response()->json(['responseCode' => 401, 'responseStatus' => false, 'responseMessage' => $error]);
                    }
                }
                $shared = NotePermission::create([
                    'note_id' => $save->id,
                    'shared_with_user_id' => $request->assignee,
                ]);
                if (!$shared) {
                    return response()->json(['responseCode' => 401, 'responseStatus' => false, 'responseMessage' => 'Something went wrong']);
                }
            }
            return response()->json(['responseCode' => 200, 'responseStatus' => true, 'responseMessage' => 'Note created successfully']);
        } else {
            return response()->json(['responseCode' => 401, 'responseStatus' => false, 'responseMessage' => 'Note created failed']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!empty($id)) {
            $note = Note::where('notes.slug', $id)
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

                ->groupBy('notes.id')
                ->orderByDesc('notes.created_at')
                ->get()->first();
            if (empty($note)) {
                return view('note.show', compact('note'));
            } else {
                return view('note.show', compact('note'));
            }
        } else {
            return view('note.show', compact('note'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note = Note::find($id);
        $delete = $note->delete();
        if ($delete) {
            return response()->json(['responseCode' => 200, 'responseStatus' => true, 'responseMessage' => 'Note deleted successfully']);
        } else {
            return response()->json(['responseCode' => 401, 'responseStatus' => false, 'responseMessage' => 'Note deleted failed']);
        }
    }

    public function changeStatus(Request $request, string $id)
    {
        $visibility = $request->visibility;
        if (empty($id) || empty($visibility)) {
            return response()->json(['responseCode' => 401, 'responseStatus' => false, 'responseMessage' => 'Akses ditolak']);
        }
        if ($visibility == 'public') {
            $note = Note::find($id);
            if ($note->visibility == 'shared') {
                NotePermission::where('note_id', $id)->delete();
            }
            $note->visibility = $visibility;
            $save = $note->save();
            if ($save) {
                return response()->json(['responseCode' => 200, 'responseStatus' => true, 'responseMessage' => 'Note updated successfully']);
            } else {
                return response()->json(['responseCode' => 401, 'responseStatus' => false, 'responseMessage' => 'Note updated failed']);
            }
        } else if ($visibility == 'private') {
            $note = Note::find($id);
            if ($note->visibility == 'shared') {
                NotePermission::where('note_id', $id)->delete();
            }
            $note->visibility = $visibility;
            $save = $note->save();
            if ($save) {
                return response()->json(['responseCode' => 200, 'responseStatus' => true, 'responseMessage' => 'Note updated successfully']);
            } else {
                return response()->json(['responseCode' => 401, 'responseStatus' => false, 'responseMessage' => 'Note updated failed']);
            }
        } else {
            $note = Note::find($id);
            $note->visibility = $visibility;
            $save = $note->save();
            if ($save) {
                $shared = NotePermission::create([
                    'note_id' => $id,
                    'shared_with_user_id' => $request->shared_to,
                ]);
                if (!$shared) {
                    return response()->json(['responseCode' => 401, 'responseStatus' => false, 'responseMessage' => 'Something went wrong']);
                } else {
                    return response()->json(['responseCode' => 200, 'responseStatus' => true, 'responseMessage' => 'Note updated successfully']);
                }
            }
        }
    }
}
