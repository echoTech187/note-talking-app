<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Note;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Note::firstOrCreate([
            'user_id' => 1,
            'content' => 'Ini adalah catatan publik tentang pemilihan template web design yang bagus. Cocok untuk inspirasi desainer.',
            'visibility' => 'public'
        ]);

        Note::firstOrCreate([
            'user_id' => 1,
            'content' => 'Beberapa ide proyek rahasia yang sedang saya kerjakan. Ini hanya untuk saya.',
            'visibility' => 'private'
        ]);

        Note::firstOrCreate([
            'user_id' => 1,
            'content' => 'Catatan ini dibuat oleh Eko Susanto dan dibagikan kepada beberapa orang.',
            'visibility' => 'shared'
        ]);

        Note::firstOrCreate([
            'user_id' => 2,
            'content' => 'Catatan ini dibuat oleh Wade Warren dan dibagikan kepada beberapa orang.',
            'visibility' => 'shared'
        ]);

        Note::firstOrCreate([
            'user_id' => 3,
            'content' => 'Catatan ini dibuat oleh Diana Prince dan dibagikan kepada beberapa orang.',
            'visibility' => 'shared'
        ]);

        Note::firstOrCreate([
            'user_id' => 4,
            'content' => 'Catatan ini dibuat oleh Claire Underwood dan dibagikan kepada beberapa orang.',
            'visibility' => 'shared'
        ]);

        Note::firstOrCreate([
            'user_id' => 4,
            'content' => 'Tips dan trik umum untuk meningkatkan produktivitas dalam pekerjaan sehari-hari.',
            'visibility' => 'public'
        ]);

        Note::firstOrCreate([
            'user_id' => 4,
            'content' => 'Entri jurnal pribadi saya hari ini. Sangat pribadi.',
            'visibility' => 'private'
        ]);
    }
}
