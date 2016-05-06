<?php

namespace App\Repositories;

use App\User;

class PatientRepository
{
   
   /**
     * Get all of the patients list.
     *
     * @return Collection
     */
    public function getPatientsList()
    {
        return User::whereHas('roles', function($q){
            $q->where('slug', 'patient');
            });
    }


    /**
     * Get a specific patient or fail.
     *
     * @return Collection
     */
    public function findOrFailPatient($id)
    {
        return User::whereHas('roles', function($q){
            $q->where('slug', 'patient');
            })->findOrFail($id);
    }
}