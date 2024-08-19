<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
            $table->string('photo_id_proof')->nullable();
            $table->string('address_proof')->nullable();
            $table->string('degree_certificate')->nullable();
            $table->string('other_document')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
