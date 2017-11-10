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
        $table->integer('equipment_type_id')->unsigned(); // equipment_types foreign key
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
