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
        Schema::create('request_peminjams', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');
            $table->date('requested_date');
            $table->date('waktu_pengembalian');
            $table->enum('status', ['pending', 'approved', 'rejected', 'borrowed', 'returned', 'overdue', 'lost'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('book_id')->references('id')->on('books')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_peminjams');
    }
};
