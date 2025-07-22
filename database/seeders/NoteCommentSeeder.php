<?php

namespace Database\Seeders;

use App\Models\NoteComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NoteComment::firstOrCreate(
            [
                'user_id' => 1,
                'note_id' => 1,
                'comment' => 'Ini adalah komentar pertama.',
                'comment_parent_id' => null
            ]
        );

        NoteComment::firstOrCreate(
            [
                'user_id' => 2,
                'note_id' => 1,
                'comment' => 'Ini adalah komentar kedua.',
                'comment_parent_id' => 1
            ]
        );

        NoteComment::firstOrCreate(
            [
                'user_id' => 3,
                'note_id' => 1,
                'comment' => 'Ini adalah komentar ketiga.',
                'comment_parent_id' => null
            ]
        );

        NoteComment::firstOrCreate(
            [
                'user_id' => 4,
                'note_id' => 1,
                'comment' => 'Ini adalah komentar keempat.',
                'comment_parent_id' => 3
            ]
        );

        NoteComment::firstOrCreate(
            [
                'user_id' => 1,
                'note_id' => 2,
                'comment' => 'Ini adalah komentar kelima.',
                'comment_parent_id' => null
            ]
        );

        NoteComment::firstOrCreate(
            [
                'user_id' => 2,
                'note_id' => 2,
                'comment' => 'Ini adalah komentar keenam.',
                'comment_parent_id' => 5
            ]
        );

        NoteComment::firstOrCreate(
            [
                'user_id' => 3,
                'note_id' => 2,
                'comment' => 'Ini adalah komentar ketujuh.',
                'comment_parent_id' => null
            ]
        );

        NoteComment::firstOrCreate(
            [
                'user_id' => 4,
                'note_id' => 3,
                'comment' => 'Ini adalah komentar kedelapan.',
                'comment_parent_id' => 7
            ]
        );
    }
}
