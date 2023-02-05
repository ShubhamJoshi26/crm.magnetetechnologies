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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('taskname')->nullable();
            $table->string('description')->nullable();
            $table->enum('ststus',[1,2,3,4,5])->nullable();
            $table->enum('priority',[1,2,3])->nullable();
            $table->string('assigned_to')->nullable();
            $table->timestamps('from_date');
            $table->timestamps('deadline_date');
            $table->timestamps('assigned_date');
            $table->string('assigned_by')->nullable();
            $table->enum('category',[1,2,3,4,5,6])->nullable();
            $table->enum('department',[1,2,3,4,])->nullable();
            $table->string('client')->nullable();
            $table->string('contact_name')->nullable();
            $table->integer('contact_number')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('ticket');
    }
};
