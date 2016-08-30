<?php 

use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

abstract class ApiTester extends TestCase {

	// All interactions to database will be included in a transactions and will be rolled back after finishing.
	// Example:
	// it_fetches_employees() that creates 5 records and it_fetches_a_signle_employee() that creates 1 records()
	// After finishing, 6 records will be deleted.
	// Note that id will not be reset, if last record be rolleb has id is 75, then next record insert into db will be 76.
	use DatabaseTransactions;

	protected $fake;

	public function __construct()
	{
		$this->fake = Faker::create();
	}

	
	protected function getJson($uri, $method = 'GET', $parameters = []) {
		return json_decode($this->call($method, $uri, $parameters)->getContent());
	}

	protected function assertObjectHasAttributes() {
		$args = func_get_args();

		$object = array_shift($args);

		foreach ($args as $attribute) {
			$this->assertObjectHasAttribute($attribute, $object);
		}
	}	

	abstract protected function getStub();
}
