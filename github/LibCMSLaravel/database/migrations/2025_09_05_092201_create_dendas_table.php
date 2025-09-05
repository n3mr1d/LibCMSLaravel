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
        Schema::create('dendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrowing_id')->constrained('peminjams');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('type', ['overdue', 'damage', 'lost']);
            $table->decimal('amount', 10, 2);
            $table->integer('days_overdue')->nullable();
            $table->decimal('daily_fine_rate', 10, 2)->nullable();
            $table->enum('status', ['unpaid', 'paid', 'waived'])->default('unpaid');
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('waived_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dendas');
    }
};
