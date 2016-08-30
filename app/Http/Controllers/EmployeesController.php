<?php

namespace App\Http\Controllers;

use App\Acme\Transformers\EmployeeTransformer;
use App\Employee;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class EmployeesController extends ApiController
{

    /**
     * Employee Tranformer
     * @var Acme\Transformers\EmployeeTransformer
     */
    protected $employeeTransformer;

    function __construct(EmployeeTransformer $employeeTransformer)
    {
        $this->employeeTransformer = $employeeTransformer;

        // $this->middleware('auth.basic', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = (int) (Input::get('limit') ? : 3);
        $employees = Employee::paginate($limit);

        // dd(get_class_methods($employees));

        return $this->respondWithPagination($employees, [
            'data' => $this->employeeTransformer->transformCollection($employees->all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!$request->has('name') || !$request->has('email')) {
            return $this->setStatusCode(422)
                        ->respondWithError('Parameters failed validation for a employee.');
        }

        $employee = Employee::create($request->all());

        return $this->respondCreated($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return $this->respondNotFound('Employee does not existed');
        }

        return $this->respond([
            'data' => $this->employeeTransformer->transform($employee)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->respond('Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->respond('Successfully Deleted');
    }
}
