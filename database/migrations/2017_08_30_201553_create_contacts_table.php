<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstnames', 45);
            $table->string('lastnames', 45);
            $table->string('email', 90)->nullable();
            $table->string('phone', 45)->nullable();
            $table->string('cell', 45)->nullable();
            $table->string('address', 250)->nullable();
            $table->enum('relation', [
              'conyugue',
              'padre',
              'madre',
              'otros familiares',
              'amig@',
              'conocid@'
            ])->nullable();
            $table->integer('employee_id')->unsigned(); // employee foreign key
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
        Schema::dropIfExists('contacts');
    }
}
