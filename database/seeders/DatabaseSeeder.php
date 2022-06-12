<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            Languages::class,
            CategoryStatus::class,
            ProductStatus::class,
            UserGroup::class,
            AdminStatus::class,
            SeederCurrency::class,
            SeedAdminPolicy::class
        ]);
    }
}
