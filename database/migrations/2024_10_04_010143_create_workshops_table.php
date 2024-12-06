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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable(); // Ensure slug is unique
            $table->string('thumbnail');
            $table->string('venue_thumbnail');
            $table->string('bg_map');
            $table->text('address');
            $table->text('about')->nullable(); // Make 'about' nullable
            $table->unsignedBigInteger('price')->nullable(); // Price can be nullable
            $table->boolean('is_open')->default(true); // Set default values if necessary
            $table->boolean('has_started')->default(false);
            $table->date('started_at')->nullable(); // Make 'started_at' nullable
            $table->time('time_at')->nullable(); // Make 'time_at' nullable
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('workshop_instructor_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops'); // Match the table name
    }
};
