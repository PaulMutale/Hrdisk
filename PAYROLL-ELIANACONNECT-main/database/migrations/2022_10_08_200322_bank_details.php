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
        Schema::table('employee_kycs', function (Blueprint $table) {
            //
            $table->string('employee_bank_name');
            $table->string('employee_bank_branch');
            $table->string('employee_bank_account_number');
            $table->string('employee_bank_account_type');
            $table->string('employee_mobile_money_number');   
            $table->string('employee_mobile_money_name');     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_kycs', function (Blueprint $table) {
            //
        });
    }
};
