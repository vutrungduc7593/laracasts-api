<?php

namespace App\Http\Controllers;

use App\Acme\Transformers\JobTransformer;
use App\Employee;
use App\Http\Requests;
use App\Job;
use Illuminate\Http\Request;

class JobsController extends ApiController
{

	protected $jobTransformer;

	function __construct(JobTransformer $jobTransformer)
	{
		$this->jobTransformer = $jobTransformer;
	}

    public function index($jobId = null) {
    	$jobs = $this->getJobs($jobId);

    	return $this->respond([
    		'data' => $this->jobTransformer->transformCollection($jobs->all())
    	]);    	
    }

    public function show($id) {
    	
    }

    private function getJobs($jobId) {
    	return $jobId ? Employee::findOrFail($jobId)->jobs : Job::all();
    }
}
