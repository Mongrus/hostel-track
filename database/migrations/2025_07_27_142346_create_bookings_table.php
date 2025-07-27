<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->foreignId('bed_id')->nullable()->constrained('beds')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('resident_id')->constrained('residents')->onDelete('cascade');

            $table->enum('booking_level', ['room', 'bed']);
            $table->enum('status', ['booked', 'daily', 'longterm']);
            $table->text('comment')->nullable();

            $table->date('start_date');
            $table->date('end_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
