<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_days', function (Blueprint $table) {
            //
            $table->integer('is_commuted');
            $table->string('leave_end_date');
            $table->integer('commutation_balance');
            $table->integer('accrued_leaves');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_days', function (Blueprint $table) {
            //
        });
    }
};
