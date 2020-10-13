<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_holders', function (Blueprint $table) {
            $table->id();
            $table->string('place');
            $table->string('category');
            $table->string('city');
            $table->string('area');
            $table->string('street');
            $table->string('name');
            $table->string('id_number');
            $table->string('phone');
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
        Schema::dropIfExists('place_holders');
    }
}
