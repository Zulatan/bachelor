<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('scheduled_time'); 
            $table->string('status')->default('pending');
            $table->timestamps(); 
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }

};

