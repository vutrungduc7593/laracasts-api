<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
    private $statusCode = IlluminateResponse::HTTP_OK;

    public function setStatusCode($statusCode)
    {
    	$this->statusCode = $statusCode;

    	return $this;
    }

    public function getStatusCode()
    {
    	return $this->statusCode;
    }

    public function respondNotFound($message = 'Not found!')
    {
    	return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondInternalError($message = 'Internal Error!')
    {
    	return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    public function respondCreated($message = 'Successfully Created!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond($message);
    }    

    public function respond($data, $headers = [])
    {
    	return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * Response with pagination
     * 
     * @param  LengthAwarePaginator $paginator 
     * @param  array    $data      
     * @return Response               
     */
    protected function respondWithPagination(LengthAwarePaginator $paginator, $data) {

        $data = array_merge($data, [
            'paginator' => [
                'total_count' => $paginator->total(),
                'total_pages' => ceil($paginator->total() / $paginator->perPage()),
                'current_page' => $paginator->currentPage(),
                'limit' => $paginator->perPage()
            ]
        ]);

        return $this->respond($data);
    }

    public function respondWithError($message)
    {
    	return $this->respond([
    		'error' => [
    			'message' => $message,
    			'status_code' => $this->getStatusCode()
    		]
    	]);	
    }    
}
