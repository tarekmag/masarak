<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand_id')->nullable()->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->bigInteger('brand_model_id')->nullable()->unsigned();
            $table->foreign('brand_model_id')->references('id')->on('brands_models')->onDelete('cascade');
            $table->string('plate_number')->unique();
            $table->string('color_en');
            $table->string('color_ar');
            $table->string('color_code')->nullable();
            $table->integer('number_seats');
            $table->year('vehicle_year');
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('vehicles');
    }
}
