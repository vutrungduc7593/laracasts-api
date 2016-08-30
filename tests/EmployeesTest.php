<?php

use App\Employee;

class EmployeesTest extends ApiTester
{
    use Factory;

    /** @test */
    function it_fetches_employees() {
        $this->times(5)->make(Employee::class);

        $this->getJson('/api/v1/employees');        
        
        $this->assertResponseOk();
    }

    /** @test */
    function it_fetches_a_single_employee() {
        $ids = $this->make(Employee::class);

        $employee = $this->getJson('/api/v1/employees/' . $ids[0])->data;        
                
        $this->assertResponseOk();
        $this->assertObjectHasAttributes($employee, 'name', 'email', 'age', 'contact_number', 'is_boss');
    }

    /** @test */
    function it_404s_if_a_employee_is_not_found() {
        $json = $this->getJson('/api/v1/employees/x');

        $this->assertResponseStatus(404);
        $this->assertObjectHasAttribute('error', $json);
    }

    /** @test */
    function it_create_a_new_employee_given_valid_parameters() {
        $json = $this->getJson('/api/v1/employees', 'POST', $this->getStub());        

        $this->assertResponseStatus(201);
        $this->assertObjectHasAttribute('id', $json);
    }

    /** @test */
    function it_throws_a_422_if_a_new_employee_request_fails_validation() {
        $this->getJson('/api/v1/employees', 'POST');

        $this->assertResponseStatus(422);
    }    

    protected function getStub() {
        return [            
            'name' => $this->fake->name,
            'email' => $this->fake->email,
            'age' => $this->fake->numberBetween(20, 50),
            'contact_number' => $this->fake->phoneNumber,
            'boss' => $this->fake->boolean
        ];
    }    
}
