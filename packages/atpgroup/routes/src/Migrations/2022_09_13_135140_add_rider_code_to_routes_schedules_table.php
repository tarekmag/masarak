<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRiderCodeToRoutesSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routes_schedules', function (Blueprint $table) {
            $table->string('rider_code')->nullable()->after('arrival_allowance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routes_schedules', function (Blueprint $table) {
            $table->dropColumn(['rider_code']);
        });
    }
}
