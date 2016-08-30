<?php

trait Factory {
	
	protected $times = 1;

	protected function times($count) {
		$this->times = $count;

		return $this;
	}

	/**
	 * Make a new record in DB
	 * 
	 * @param  object $type   
	 * @param  array  $fields 
	 * @return array  $ids
	 */
	protected function make($type, array $fields = []) {
		$ids = [];

        while ($this->times--) {

        	$stub = array_merge($this->getStub(), $fields);

            array_push($ids, $type::create($stub)->id);
        }

        return $ids;
	}
}