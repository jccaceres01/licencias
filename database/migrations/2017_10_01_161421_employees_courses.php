<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeesCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('employees_courses', function(Blueprint $table){
        $table->increments('id');
        $table->integer('employee_id')->unsigned(); // Employee foreign key
        $table->integer('course_id')->unsigned(); // Course foreign key
        $table->date('date')->nullable();
        $table->string('filepath')->nullable();
        $table->boolean('carnet_print')->nullable()->default(true); // Print the course in the canet back.
        $table->unique(['employee_id', 'course_id']); // Allow only one course by employee
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('employees_courses');
    }
}
