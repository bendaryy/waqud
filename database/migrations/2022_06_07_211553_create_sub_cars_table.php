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
            // $table->string('company');
            $table->foreignId('company')->constrained("companies")->onUpdate('cascade')->onDelete('cascade');

            $table->string('car_letters')->nullable();
            $table->string('car_numbers')->nullable();
            $table->string('field4')->nullable();
            $table->string('field5')->nullable();
            $table->string('field6')->nullable();
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
