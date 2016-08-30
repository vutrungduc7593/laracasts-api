<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        \App\User::create([
        	'name' => 'slucis',
        	'email' => 'slucis7593@gmail.com',
        	'password' => bcrypt('VuDuc@123')
        ]);
    }
}
