<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{



    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recruiter_id');
            $table->string('position_name');
            $table->string('category');
            $table->enum('job_type', ['Freelancer', 'Part Time', 'Full Time', 'Contract', 'Remote']);
            $table->unsignedInteger('vacancy'); // Use unsigned integer for vacancy
            $table->date('start_date');
            $table->date('end_date');
            $table->string('salary_range_from')->nullable();
            $table->string('salary_range_to')->nullable();
            $table->string('location');
            $table->string('experience');
            $table->text('description')->nullable();
            $table->boolean('status')->default(1); // Assuming status field indicates active/inactive jobs
            $table->boolean('isFeatured')->default(0); // Assuming isFeatured field indicates featured jobs
            $table->timestamps();

            $table->foreign('recruiter_id')->references('id')->on('recruiters')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */


    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};