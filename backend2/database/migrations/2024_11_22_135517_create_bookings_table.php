<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('customer')->constrained('users')->onDelete('cascade'); // FK to users (customers)
            $table->foreignId('admin')->nullable()->constrained('users')->onDelete('cascade'); // FK to users (admins)
            $table->timestamp('bookingTime'); // Date and time of booking
            $table->boolean('accepted')->default(false); // Whether the booking is accepted
            $table->timestamps(); // Adds created_at and updated_at
            $table->softDeletes(); // Adds deleted_at for soft deletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings'); // Rollback (delete the table)
    }
};