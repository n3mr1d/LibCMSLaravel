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
        Schema::create('peminjams', function (Blueprint $table) {
            $table->id();
            $table->string('peminjams_number')->unique();
            $table->foreignId('peminjaman_request_id')->constrained('request_peminjams');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('book_id')->constrained('books');
            $table->date('tanggal_pemijaman');
            $table->date('tanggal _pengembalian_asli');
            $table->date('tangga_pengembalian')->nullable();
            $table->enum('status', ['borrowed', 'returned', 'overdue', 'lost'])->default('borrowed');
            $table->foreignId('borrowed_by')->constrained('users');
            $table->foreignId('returned_to')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjams');
    }
};
