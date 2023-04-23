<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('likes')->insert([
            'user_id' => 1, 
            'product_id' => 1, 
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(), 
        ]);
    }
}
