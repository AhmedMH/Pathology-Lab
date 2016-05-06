<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'result', 'report_id'
    ];
    
  
    /**
     * Get the report that belongs to the test.
     */
    public function test()
    {
    	return $this->belongsTo(Rerport::class);
    }
}
