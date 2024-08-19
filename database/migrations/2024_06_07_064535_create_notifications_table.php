<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // Autoincrement primary key
            $table->string('recruiter_email');
            $table->string('applicant_email');
            $table->text('message');
            $table->timestamp('created_at')->useCurrent(); // Timestamp when the message was inserted
            $table->timestamp('updated_at')->nullable(); // Timestamp when the message was last updated
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
