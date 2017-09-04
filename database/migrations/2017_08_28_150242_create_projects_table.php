<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 90);
            $table->string('address', 250)->nullable();
            $table->integer('country_id')->unsigned(); //Country foreign key
            $table->string('description', 250);
            $table->string('email', 90)->nullable();
            $table->float('latitude', 9, 2)->nullable();
            $table->float('longitude', 9, 2)->nullable();
            $table->float('altitude', 9, 2)->nullable();
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
        Schema::dropIfExists('projects');
    }
}
