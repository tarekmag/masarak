<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes_schedules', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('route_id')->unsigned();
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');

            $table->bigInteger('supplier_id')->unsigned()->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->bigInteger('driver_id')->unsigned();
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');

            $table->bigInteger('vehicle_id')->unsigned();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');

            $table->double('client_price', 12, 2)->default(0);
            $table->double('driver_price', 12, 2)->default(0);

            $table->enum("type", ['scheduled', 'manual', 'special_request'])->default('scheduled');
            $table->enum("class", ['economy', 'business'])->default('economy');

            $table->json('days');

            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->time('start_time');
            $table->smallInteger('arrival_allowance')->default(0);

            $table->boolean('is_return')->default(0);
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
        Schema::dropIfExists('routes_schedules');
    }
}
