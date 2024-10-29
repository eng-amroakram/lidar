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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('date');
            $table->integer('participants_number');
            $table->integer('recording_attempts')->default(0);
            $table->string('username');
            $table->string('id_number', 10);
            $table->enum('status', ['Blocked', 'Ignored'])->default('Blocked');
            $table->string('restricted_image')->nullable(); // Path to the image if needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
