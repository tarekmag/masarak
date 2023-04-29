<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->nullable();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('logo')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->text('address_ar')->nullable();
            $table->text('address_en')->nullable();
            $table->boolean('main_branch')->default(0);
            $table->boolean('display_employee_image')->default(0);
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
        Schema::dropIfExists('companies');
    }
}
