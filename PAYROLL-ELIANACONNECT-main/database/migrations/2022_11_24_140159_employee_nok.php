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
             $table->string('nok');
            $table->string('name_of_nok');
            $table->string('phone_of_nok');
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
