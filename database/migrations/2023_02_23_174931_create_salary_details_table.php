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
        Schema::create('salary_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salary_id');
            $table->foreign('salary_id')->references('id')->on('salary');
            $table->string('component');
            $table->float('basic');
            $table->float('da');
            $table->float('hra');
            $table->float('esic');
            $table->float('pf_employee');
            $table->float('pf_employer');
            $table->float('ca');
            $table->float('ma');
            $table->float('lta');
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
        Schema::dropIfExists('salary_details');
    }
};
