<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Languages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            [
                'id' => 1,
                'name' => "English",
                'abr' => 'en',
                'local' => "en_US",
                'available' => 1,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ],
            [
                'id' => 2,
                'name' => "Spanish",
                'abr' => 'es',
                'local' => "es_ES",
                'available' => 1,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ],
            [
                'id' => 3,
                'name' => "Italian",
                'abr' => 'it',
                'local' => "it_IT",
                'available' => 1,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ],
            [
                'id' => 4,
                'name' => "Hindi",
                'abr' => 'hi',
                'local' => "hi_IN",
                'available' => 0,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]
        ]);
    }
}
