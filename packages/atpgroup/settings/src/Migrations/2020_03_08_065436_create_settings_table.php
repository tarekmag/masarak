<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('setting_key');
            $table->string('setting_value')->nullable();
            $table->enum('setting_form_type', ['input', 'textarea', 'checkbox', 'image']);
            $table->enum('setting_type', ['text', 'number', 'url', 'email', 'color', 'time', 'date', 'none']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
