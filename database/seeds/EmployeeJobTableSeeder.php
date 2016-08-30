<?php

use App\Employee;
use App\Job;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class EmployeeJobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $employeeIds = Employee::lists('id')->toArray();
        $jobIds = Job::lists('id')->toArray();

        foreach (range(0, 30) as $index) {
        	DB::table('employee_job')->insert([
        		'employee_id' => $faker->randomElement($employeeIds),
        		'job_id' => $faker->randomElement($jobIds)
        	]);
        }
    }
}
