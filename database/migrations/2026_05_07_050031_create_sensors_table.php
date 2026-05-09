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
        Schema::create('sensors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('tank_id')->constrained('tanks')->cascadeOnDelete(); 
            $table->foreignUuid('terminal_id')->constrained('terminals')->cascadeOnDelete(); 
            $table->string('name');
            $table->string('serial_number')->unique();
            $table->string('sensor_type');
            $table->string('manufacturer')->nullable();
            $table->date('installation_date')->nullable();
            $table->date('last_maintenance_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
};
