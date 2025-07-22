<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\NoteComment;

class NoteCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'note_id' => 'required',
            'comment' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json(['responseCode' => 401, 'responseStatus' => false, 'responseMessage' => $validate->errors()->all()]);
        }


        $data = [
            'note_id' => $request->note_id,
            'comment' => $request->comment,
            'user_id' => auth('web')->user()->id,
            'comment_parent_id' => $request->comment_id ?? null,
        ];

        $save = NoteComment::create($data);
        if ($save) {
            return response()->json(['responseCode' => 201, 'responseStatus' => true]);
        } else {
            return response()->json(['responseCode' => 401, 'responseStatus' => false, 'responseMessage' => 'Something went wrong']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
