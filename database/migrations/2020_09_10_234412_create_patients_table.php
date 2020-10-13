<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['healthy','injured ','contact']);
            $table->string('id_number')->unique();
            $table->string('first_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('granddad_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('gender',['male','female']);
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('area')->nullable();
            $table->date('date_injury')->nullable();
            $table->integer('injury_days')->default(0);
            $table->date('date_healing')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('patients');
    }
}
