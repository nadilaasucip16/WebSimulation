<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        Materi::insert([
            [
                'title'      => 'Enkapsulasi',
                'content'    => "Enkapsulasi adalah konsep dalam pemrograman berorientasi objek yang digunakan untuk membungkus data dan method ke dalam satu class.\n\nEnkapsulasi membantu melindungi data agar tidak dapat diakses secara langsung dari luar class, sehingga menjaga integritas data.",
                'video_path' => null,
                'color'      => 'green',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'Inheritance',
                'content'    => "Inheritance atau pewarisan adalah kemampuan class untuk mewarisi atribut dan method dari class lain (Superclass ke Subclass).\n\nKonsep ini membantu mengurangi pengulangan kode (DRY) dan meningkatkan efisiensi pengembangan program.",
                'video_path' => null,
                'color'      => 'blue',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
