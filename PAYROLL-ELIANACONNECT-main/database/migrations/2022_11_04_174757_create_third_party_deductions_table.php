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
        Schema::create('third_party_deductions', function (Blueprint $table) {
            $table->id();
            $table->integer('amount'); 
            $table->string('security_number'); 
            $table->string('employee_id'); 
            $table->string('deduction_code'); 
            $table->string('deduction_name'); 
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
        Schema::dropIfExists('third_party_deductions');
    }
};
