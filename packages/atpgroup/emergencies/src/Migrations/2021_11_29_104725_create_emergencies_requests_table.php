<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciesRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencies_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('emergency_id')->unsigned()->index();
            $table->foreign('emergency_id')->references('id')->on('emergencies')->onDelete('cascade');
            $table->text('message')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('emergencies_requests');
    }
}
