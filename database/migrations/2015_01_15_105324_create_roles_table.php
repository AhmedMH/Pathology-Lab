<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->integer('level')->default(1);
            $table->timestamps();
        });

        
        // /*Create the operator user role*/
        // DB::table('roles')->insert(
        //     array(
        //         'name' => 'Operator',
        //         'slug' => 'operator',
        //         'description' => 'Operator can log in to the system to perform - Reports CRUD (Multiple tests and results in each report) - Patients CRUD (including pass code)', 
        //         'level' => 1
        //         )
        //     );
        
        // /*Create the patient user role*/
        // DB::table('roles')->insert(
        //     array(
        //         'name' => 'Patient',
        //         'slug' => 'patient',
        //         'description' => 'Patient can log in to the system to perform - Display list of his reports. - Display a report details as a page. - Export a report as PDF - Mail a report as PDF', 
        //         'level' => 1
        //         )
        //     );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }
}
