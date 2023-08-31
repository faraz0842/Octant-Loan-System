<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUwIncompleteFinishInLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan', function (Blueprint $table) {
            $table->date('uw_incomplete_start')->after('uw_additional_fee_comments')->nullable();
            $table->date('uw_incomplete_finish')->after('uw_incomplete_start')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan', function (Blueprint $table) {
            $table->dropColumn('uw_incomplete_start');
            $table->dropColumn('uw_incomplete_finish');
        });
    }
}
