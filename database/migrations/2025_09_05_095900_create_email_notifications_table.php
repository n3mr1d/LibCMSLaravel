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
        Schema::create('email_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('type'); // borrowing_request, approval, reminder, overdue, etc. 
            $table->string('subject');
            $table->text('body');
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $table->timestamp('sent_at')->nullable();
            $table->text('error_message')->nullable();
            $table->json('metadata')->nullable(); // additional data like borrowing_id, etc. 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_notifications');
    }
};
