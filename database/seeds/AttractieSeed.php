<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttractieSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attracties')->insert([
            'user_id' => 1,
            'title' => 'Achtbaan',
            'description' => 'Dit is een achtbaan!',
            'cover_image' => 'Achtbaan.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('attracties')->insert([
            'user_id' => 1,
            'title' => 'Ghostship',
            'description' => 'Dit is een schip!',
            'cover_image' => 'Ghostship.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('attracties')->insert([
            'user_id' => 1,
            'title' => 'Locomotief',
            'description' => 'Dit is een locomotief!',
            'cover_image' => 'Locomotief.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('attracties')->insert([
            'user_id' => 1,
            'title' => 'Reuzenrad',
            'description' => 'Dit is een reuzenrad!',
            'cover_image' => 'Reuzenrad.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('attracties')->insert([
            'user_id' => 1,
            'title' => 'Zweefmolen',
            'description' => 'Dit is een zweefmolen!',
            'cover_image' => 'Zweefmolen.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
