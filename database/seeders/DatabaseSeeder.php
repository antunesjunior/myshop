<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();

        DB::table('provinces')->insert([
            ['name' => 'Luanda'],
            ['name' => 'Bengo'],
            ['name' => 'Benguela'],
            ['name' => 'Bie'],
            ['name' => 'Cabinda'],
            ['name' => 'Cuando-Cubango'],
            ['name' => 'Cuanza Norte'],
            ['name' => 'Cuanza Sul'],
            ['name' => 'Cunene'],
            ['name' => 'Huambo'],
            ['name' => 'Huíla'],
            ['name' => 'Lunda Norte'],
            ['name' => 'Lunda Sul'],
            ['name' => 'Malanje'],
            ['name' => 'Moxico'],
            ['name' => 'Namibe'],
            ['name' => 'Uíge'],
            ['name' => 'Zaire']
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
