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
        Schema::create('enquiry', function (Blueprint $table) {
            $table->id();
            $table->string('enquiryno')->nullable()->unique();
            $table->string('academicyearid')->nullable();
            $table->string('classid')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('mothername')->nullable();
            $table->string('fathername')->nullable();
            $table->string('dateofbirth')->nullable();
            $table->string('emailid')->nullable();
            $table->string('mobileno')->nullable();
            $table->string('genderid')->nullable();
            $table->string('address')->nullable();
            $table->string('currentschoolname')->nullable();
            $table->string('sourceofinformationid')->nullable();
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
        //
    }
};
