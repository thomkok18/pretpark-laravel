<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'title' => 'Ticket',
            'description' => 'Hiermee krijg je toegang tot het pretpark.',
            'stock' => 50,
            'price' => '5.50',
            'cover_image' => 'Ticket.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'title' => 'VIP-Ticket',
            'description' => 'Hiermee krijg je voorrang in de rijen in het pretpark.',
            'stock' => 50,
            'price' => '12.50',
            'cover_image' => 'VIP-Ticket.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
