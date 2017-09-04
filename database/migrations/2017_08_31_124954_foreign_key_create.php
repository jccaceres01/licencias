<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeyCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /**
       * projects foreign keys create
       */
      Schema::table('projects', function(Blueprint $table) {
        // Projects - Countries foreign
        $table->foreign('country_id')
          ->references('id')
          ->on('countries')
          ->onUpdate('cascade')
          ->onDelete('restrict');
      });
      /**
       * Employees foreign keys create
       */
      Schema::table('employees', function(Blueprint $table) {
        // Employees - Project foreign create
        $table->foreign('project_id')
          ->references('id')
          ->on('projects')
          ->onUpdate('cascade')
          ->onDelete('restrict');
        // Employees - Countries foreign create
        $table->foreign('country_id')
          ->references('id')
          ->on('countries')
          ->onUpdate('cascade')
          ->onDelete('restrict');
      });
      /**
       * Employess_equiment_types foreign keys create
       */
      Schema::table('employees_equipment_types', function(Blueprint $table) {
        // Employees_equipment_types - Employees  foreign create
        $table->foreign('employee_id')
          ->references('id')
          ->on('employees')
          ->onUpdate('cascade')
          ->onDelete('restrict');
        // Employees_equipment_types - Equipment_types foreign create
        $table->foreign('equipment_type_id')
          ->references('id')
          ->on('equipment_types')
          ->onUpdate('cascade')
          ->onDelete('restrict');
      });

      /**
       * Contacts foreign key creates
       */
      Schema::table('contacts', function(Blueprint $table) {
        // Contacts - employees foreign key create
        $table->foreign('employee_id')
          ->references('id')
          ->on('employees')
          ->onUpdate('cascade')
          ->onDelete('restrict');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      /**
       * Projects foreign keys drop
       */
      Schema::table('projects', function(Blueprint $table) {
        // Projects - Countries foreign drop
        $table->dropForeign('projects_country_id_foreign');
      });

      /**
       * Employees foreign keys drop
       */
      Schema::table('employees', function(Blueprint $table) {
        // Employees - Projects foreign drop
        $table->dropForeign('employees_project_id_foreign');
        // Employees - Countries foreign drop
        $table->dropForeign('employees_country_id_foreign');
      });

      /**
       * Employees_equipment_types foreign keys drop
       */
      Schema::table('employees_equipment_types', function(Blueprint $table) {
        // Employees_equipment_types - employees foreign key drop
        $table->dropForeign('employees_equipment_types_employee_id_foreign');
        // Employees_equipment_types - Equipment_types  foreign key drop
        $table->dropForeign(
          'employees_equipment_types_equipment_type_id_foreign'
        );
      });

      /**
       * Contacts foreign keys drop
       */
      Schema::table('contacts', function(Blueprint $table) {
        // Drop contacts - employeeforeign key
        $table->dropForeign('contacts_employee_id_foreign');
      });
    }
}
