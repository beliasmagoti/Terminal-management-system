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
        Schema::create('tank_readings', function (Blueprint $table) {
        
            $table->uuid('id')->primary();
            $table->string('name');
            $table->foreignUuid('terminal_id')->constrained('terminals')->cascadeOnDelete(); 
            $table->foreignUuid('sensor_id')->constrained('sensors')->cascadeOnDelete(); 
            $table->decimal('fuel_level_litres', 15, 2);
            $table->string('water_level');
            $table->decimal('current_volume', 15, 2);
            $table->decimal('fuel_level_percent', 5, 2);
            $table->decimal('temperature_celcius', 5, 2);
            $table->decimal('pressure_kpa', 10, 2);
            $table->decimal('density', 5, 2);
            $table->timestamp('recorded_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tank_readings');
    }
};
