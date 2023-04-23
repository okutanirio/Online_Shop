<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class ProductusersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productusers')->insert([
            'user_id' => 1, 
            'product_id' => 1, 
            'status' => 0, 
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(), 
        ]);
    }
}
