<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'email', 'age', 'contact_number', 'boss', ];

    /**
     * Reference jobs that employee belongs to
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jobs() {
    	return $this->belongsToMany(Job::class);
    }
}
