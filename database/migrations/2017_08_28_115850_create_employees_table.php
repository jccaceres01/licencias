<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
          $table->increments('id');
          $table->string('code', 15)->unique();
          $table->string('firstnames', 90);
          $table->string('lastnames', 90);
          $table->string('nickname', 90)->nullable();
          $table->string('identity_document', 45)->nullable()->unique();
          $table->date('birthdate')->nullable();
          $table->date('hiredate')->nullable();
          $table->enum('gender', ['M', 'F'])->nullable();
          $table->enum('blood', [
            'O+',
            'O-',
            'A+',
            'A-',
            'B+',
            'B-',
            'AB+',
            'AB-'
          ])->nullable();
          $table->string('address')->nullable();
          $table->string('email', 90)->nullable();
          $table->string('phonenumber', 45)->nullable();
          $table->string('cellphone', 45)->nullable();
          $table->string('position', 90)->nullable();
          $table->string('imgpath', 250)->nullable();
          $table->string('drive_license', 45)->nullable();
          $table->enum('drive_license_category', [
            '01 Conductor',
            '02 Conductor',
            '03 Primera  Pesados',
            '04 Segunda  Pesados',
            '05 Especial'
          ])->nullable();
          $table->date('drive_license_start')->nullable();
          $table->date('drive_license_end')->nullable();
          $table->string('drive_license_restriction')->nullable()
            ->default('Ninguna');
          $table->integer('project_id')->unsigned(); // Project foreign key
          $table->enum('status', ['activo', 'cancelado', 'parado'])
            ->default('activo');
          $table->integer('country_id')->unsigned()->nullable(); // Nationality, countries foreign key
          $table->enum('employee_type', [
            'encargado de proyecto',
            'administrativo',
            'supervisor general',
            'supervisor de grupo',
            'supervisor',
            'mecanico',
            'operador'
          ])->nullable();
          $table->integer('group_id')->unsigned()->nullable();
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
        Schema::dropIfExists('employees');
    }
}
