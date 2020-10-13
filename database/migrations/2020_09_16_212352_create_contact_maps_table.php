<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_maps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id'); // الشخص المخالط
            $table->foreign('contact_id')->references('id')->on('patients');

            $table->unsignedBigInteger('contact_with_id'); // الشخص المخالط به
            $table->foreign('contact_with_id')->references('id')->on('patients');

            $table->string('place');
            $table->timestamp('date');
            $table->enum('recognition_method',[1,2]);
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
        Schema::dropIfExists('contact_maps');
    }
}
