<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruiters', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('company_id');
            $table->string('name');
            $table->string('department');
            $table->string('mobile');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('suspended')->default(false); // Suspension status
            $table->string('suspend_message')->nullable(); // Suspension message
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruiters');
    }
}
