<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(0, 9) as $index) {
        	\App\Employee::create([
        		'name' => $faker->name,
        		'email' => $faker->email,
        		'age' => $faker->numberBetween(20, 50),
        		'contact_number' => $faker->phoneNumber,
        		'boss' => $faker->boolean
        	]);
        }
    }
}
