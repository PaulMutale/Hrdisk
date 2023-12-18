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
        Schema::create('employee_kycs', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->string('employee_email');
            $table->string('employee_address');
            $table->string('employee_gender');
            $table->string('employee_photo');       
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
        Schema::dropIfExists('employee_kycs');
    }
};
