<?php

namespace Database\Seeders;

use App\Models\Shop\Category\CategoryStatus as CategoryCategoryStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoryStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_status')->insert([
            [
                'id' => 1,
                'name' => 'active',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ],
            [
                'id' => 2,
                'name' => 'inactive',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]
        ]);
    }
}
