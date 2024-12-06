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
        Schema::create('booking_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('customer_bank_name');
            $table->string('customer_bank_account');
            $table->string('customer_bank_number');
            $table->string('booking_trx_id')->unique(); // Unique constraint for transaction ID
            $table->string('proof');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('total_amount');
            $table->boolean('is_paid')->default(false);
            $table->foreignId('workshop_id')->constrained()->cascadeOnDelete(); // Foreign key with cascade delete
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_transactions');
    }
};
