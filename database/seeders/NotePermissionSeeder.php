<?php

namespace Database\Seeders;

use App\Models\NotePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NotePermission::firstOrCreate([
            'shared_with_user_id' => 1,
            'note_id' => 1
        ]);

        NotePermission::firstOrCreate([
            'shared_with_user_id' => 1,
            'note_id' => 2
        ]);

        NotePermission::firstOrCreate([
            'shared_with_user_id' => 1,
            'note_id' => 3
        ]);

        NotePermission::firstOrCreate([
            'shared_with_user_id' => 2,
            'note_id' => 4
        ]);

        NotePermission::firstOrCreate([
            'shared_with_user_id' => 2,
            'note_id' => 5
        ]);

        NotePermission::firstOrCreate([
            'shared_with_user_id' => 3,
            'note_id' => 6
        ]);

        NotePermission::firstOrCreate([
            'shared_with_user_id' => 4,
            'note_id' => 1
        ]);
    }
}
