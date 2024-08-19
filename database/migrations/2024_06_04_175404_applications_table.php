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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_post_id'); // Foreign key to job posts table
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('gender');
            $table->string('contact');
            $table->string('resume')->nullable(); // Path to resume file
            $table->string('status')->default('Unverified'); // Application status
            $table->string('round_status')->default('Not set'); // Current round status
            $table->string('photo_id_proof')->nullable();
            $table->string('address_proof')->nullable();
            $table->string('degree_certificate')->nullable();
            $table->string('other_document')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('job_post_id')->references('id')->on('job_posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
