<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        'employees',
        'jobs',
        'employee_job'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        Eloquent::unguard();

        // $this->call(UsersTableSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(JobsTableSeeder::class);
        $this->call(EmployeeJobTableSeeder::class);
    }

    private function cleanDatabase() {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();   
        }
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }    
}
