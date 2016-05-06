<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Report extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	 protected $fillable = ['name', 'operator_id', 'patient_id'];

	/**
     * Get the operator that owns the report.
     */
    public function operator()
    {
    	return $this->belongsTo(User::class);
    }

    /**
     * Get the patient that belongs to the report.
     */
    public function patient()
    {
    	return $this->belongsTo(User::class);
    }

     /**
     * Get all of the tests for the report.
     */
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
