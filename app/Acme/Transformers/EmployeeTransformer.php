<?php

namespace App\Acme\Transformers;

class EmployeeTransformer extends Transformer {

	/**
     * Tranform employee
     * @param   $employee 
     * @return            
     */
    public function transform($employee)
    {
        return [
            'id' => $employee['id'],
            'name' => $employee['name'],
            'email' => $employee['email'],
            'age' => $employee['age'],
            'contact_number' => $employee['contact_number'],
            'is_boss' => (boolean) $employee['boss']
        ];
    }

}
