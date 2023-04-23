<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin1', 
            'email' => 'admin1@admin.com', 
            'password' => 'admin1234', 
            'role' => 1, 
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now(), 
        ]);
    }
}
