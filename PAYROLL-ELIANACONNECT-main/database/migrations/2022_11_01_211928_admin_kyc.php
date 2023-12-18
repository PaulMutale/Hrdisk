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
        Schema::table('admins', function (Blueprint $table) {
            //
            $table->string('principle_name'); 
            $table->string('principle_email'); 
            $table->string('principle_city'); 
            $table->string('principle_province'); 
            $table->string('company_bank_name'); 
            $table->string('company_bank_branch'); 
            $table->string('bank_account_name');
            $table->string('bank_account_type');            
            $table->string('principle_nrc'); 
            $table->string('company_pacra'); 
            $table->string('principle_passport_photo');
            $table->integer('kyc_status');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
        });
    }
};
