<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Thom Kok',
            'email' => 'thomkok13@hotmail.com',
            'password' => bcrypt('testen13'),
            'cover_image' => 'thomkok21.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
