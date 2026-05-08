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
        Schema::create('alerts', function (Blueprint $table) {
    
            $table->uuid()->primary();
            $table->foreignUuid('tank_id')->constrained('tanks')->cascadeOnDelete();
            $table->enum('alert_type', [
                'low_level',
                'critical_level',
                'overflow',
                'high_temperature',
                'pressure_issue',
                'water_detected',
                'sensor_failure',
                'leak_detected'
            ]);
             $table->enum('severity', [
                'low',
                'mediumm',
                'high',
                'critical',
            ]);
            $table->text('message');
            $table->boolean('resolved');
            $table->timestamp('triggered_at');
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
