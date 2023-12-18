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
        Schema::create('leave_days', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('employee_id');
            $table->string('leave_name');   
            $table->integer('exhausted_leaves');  
            $table->integer('remaining_leaves');  
            $table->timestamps();
        });



        Schema::table('leave_days', function($table) {
            $table->foreign('employee_id')->references('id')->on('Employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_days');
    }
};
