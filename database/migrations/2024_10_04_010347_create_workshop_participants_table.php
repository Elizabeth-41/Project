<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workshop_participants', function (Blueprint $table) {
            $table->id(); // This will create an auto-incrementing primary key 'id'
            $table->string('name'); // Change 'bigint' to 'string' for name
            $table->string('occupation'); // Use string for occupation
            $table->string('email'); // Use string for email
            $table->foreignId('workshop_id')->constrained()->cascadeOnDelete(); // Assuming this is a foreign key
            $table->foreignId('booking_transaction_id')->constrained()->cascadeOnDelete(); // Foreign key for booking transactions
            $table->softDeletes(); // For soft deletes
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshop_participants');
    }
}
