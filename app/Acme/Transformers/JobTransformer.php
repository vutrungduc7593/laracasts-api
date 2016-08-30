<?php

namespace App\Acme\Transformers;

class JobTransformer extends Transformer {
    
	/**
     * Tranform job
     * @param   $job
     * @return            
     */
    public function transform($job)
    {
        return [
            'name' => $job['name']
        ];
    }

}
