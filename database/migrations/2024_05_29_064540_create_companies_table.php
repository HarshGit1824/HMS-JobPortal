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
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id('id');
            $table->string('ceoname')->nullable();
            $table->string('cname');
            $table->string('caddress')->nullable();
            $table->string('email')->unique();
            $table->string('link')->unique();
            $table->string('mobile');
            $table->string('gstn')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
            $table->timestamps();
        });   
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
    
};
