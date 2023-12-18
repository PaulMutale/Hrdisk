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
        Schema::create('loans', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('employee_id');
            $table->string('employee_loan_amount');   
            $table->string('employee_total_repayment');  
            $table->string('employee_duration');  
            $table->string('employee_monthly');          
            $table->timestamps();
        });



        Schema::table('loans', function($table) {
            $table->foreign('employee_id')->references('id')->on('self_add_employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
};
