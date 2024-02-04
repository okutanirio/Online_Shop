<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'type_id'       => 1, 
            'name'          => 'sample1', 
            'price'         => 1000, 
            'info'          => 'sample_sample_sample_sample_sample_sample', 
            'description'   => 'sample_sample_sample_sample_sample_sample', 
            'image'         => 'a', 
            'created_at'    => Carbon::now(), 
            'updated_at'    => Carbon::now(), 
        ]);
    }
}
