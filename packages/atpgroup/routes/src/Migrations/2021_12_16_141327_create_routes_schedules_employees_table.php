<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesSchedulesEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes_schedules_employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('route_id')->unsigned();
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
            $table->bigInteger('route_schedule_id')->unsigned();
            $table->foreign('route_schedule_id')->references('id')->on('routes_schedules')->onDelete('cascade');
            $table->bigInteger('station_id')->unsigned()->nullable();
            $table->foreign('station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->bigInteger('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->double('pickup_lat')->nullable();
            $table->double('pickup_lng')->nullable();
            $table->double('drop_lat')->nullable();
            $table->double('drop_lng')->nullable();
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
        Schema::dropIfExists('routes_schedules_employees');
    }
}
