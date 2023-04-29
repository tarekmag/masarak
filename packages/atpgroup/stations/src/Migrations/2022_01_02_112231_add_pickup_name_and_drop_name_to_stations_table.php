<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPickupNameAndDropNameToStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stations', function (Blueprint $table) {
            $table->string('pickup_name_en')->after('name_en')->nullable();
            $table->string('pickup_name_ar')->nullable();
            $table->string('drop_name_en')->nullable();
            $table->string('drop_name_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stations', function (Blueprint $table) {
            $table->dropColumn('pickup_name');
            $table->dropColumn('drop_name');
        });
    }
}
