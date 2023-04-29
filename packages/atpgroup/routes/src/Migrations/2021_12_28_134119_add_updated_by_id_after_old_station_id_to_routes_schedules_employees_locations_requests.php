<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdatedByIdAfterOldStationIdToRoutesSchedulesEmployeesLocationsRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routes_schedules_employees_locations_requests', function (Blueprint $table) {
            $table->bigInteger("updated_by_id")->after('employee_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routes_schedules_employees_locations_requests', function (Blueprint $table) {
            $table->dropColumn('updated_by_id');
        });
    }
}
