<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeesEquipmentTypesCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('employees_equipment_types', function(Blueprint $table) {
        $table->increments('id');
        $table->integer('employee_id')->unsigned();  // Employees foreign key
        $table->integer('equipment_type_id')->unsigned(); // Equipment_types foreign key
        $table->date('date')->nullable(); // Equipment type Asignation date
        $table->string('filepath', 255)->nullable(); // Hard copy of document or certificate
        $table->boolean('carnet_print')->default(0); // Print in carnet?
        $table->unique(['employee_id', 'equipment_type_id']); // Unique for avoid duplicates
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
      Schema::dropIfExists('employees_equipment_types');
    }
}
