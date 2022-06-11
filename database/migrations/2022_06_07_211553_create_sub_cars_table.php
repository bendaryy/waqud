<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_cars', function (Blueprint $table) {
            $table->id();
            $table->string('main_car')->nullable();
            $table->string('sub_car')->nullable();
            $table->string('model')->nullable();
            $table->string('engine_type')->nullable();
            $table->string('image')->nullable();
            $table->string('company')->nullable();
            $table->string('field2')->nullable();
            $table->string('field3')->nullable();
            $table->string('field4')->nullable();
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
        Schema::dropIfExists('sub_cars');
    }
}
