<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesSchedulesEmployeesLocationsRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes_schedules_employees_locations_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('route_id')->unsigned();
            $table->foreign('route_id', 'routes_schedules_employees_l_r_route_id_foreign')->references('id')->on('routes')->onDelete('cascade');

            $table->bigInteger('route_schedule_id')->unsigned();
            $table->foreign('route_schedule_id', 'routes_schedules_employees_l_r_route_schedule_id_foreign')->references('id')->on('routes_schedules')->onDelete('cascade');

            $table->bigInteger('station_id')->unsigned()->nullable();
            $table->foreign('station_id', 'routes_schedules_employees_l_r_station_id_foreign')->references('id')->on('stations')->onDelete('cascade');

            $table->bigInteger('employee_id')->unsigned();
            $table->foreign('employee_id', 'routes_schedules_employees_l_r_employee_id_foreign')->references('id')->on('employees')->onDelete('cascade');

            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
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
        Schema::dropIfExists('routes_schedules_employees_locations_requests');
    }
}
