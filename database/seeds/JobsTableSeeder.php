<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class JobsTableSeeder extends Seeder
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
        	\App\Job::create([
        		'name' => $faker->word
        	]);
        }
    }
}
