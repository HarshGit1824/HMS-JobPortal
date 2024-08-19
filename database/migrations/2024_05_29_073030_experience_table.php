<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('role');
            $table->string('emp_type');
            $table->string('company');
            $table->string('location');
            $table->string('location_type');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('experiences');
    }
};
