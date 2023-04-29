<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyBranchIdsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('company_id')->nullable()->unsigned()->after('role_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');

            $table->bigInteger('branch_id')->nullable()->unsigned()->after('company_id');
            $table->foreign('branch_id')->references('id')->on('companies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_company_id_foreign');
            $table->dropColumn('company_id');

            $table->dropForeign('users_branch_id_foreign');
            $table->dropColumn('branch_id');
        });
    }
}
