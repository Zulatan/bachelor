<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('date'); 
            $table->timestamp('time'); 
            $table->boolean('accepted')->default(false); // is the booking accepted?
            $table->string('status')->default('pending'); // service pending or done?
            $table->unsignedBigInteger('service_id'); // id to reference the service
            $table->timestamps(); // Adds created_at and updated_at
            $table->softDeletes(); // Adds deleted_at for soft deletes
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings'); // Rollback (delete the table)
    }
};

