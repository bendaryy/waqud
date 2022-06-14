<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetrolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petrols', function (Blueprint $table) {
            $table->id();
            // $table->string('companyId');
            // $table->string('carId');
            $table->string('litre');
            $table->string('pound');
            $table->foreignId('companyId')->constrained("companies")->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('carId')->constrained("sub_cars")->onUpdate('cascade')->onDelete('cascade');
            $table->string('field1')->nullable();
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
        Schema::dropIfExists('petrols');
    }
}
