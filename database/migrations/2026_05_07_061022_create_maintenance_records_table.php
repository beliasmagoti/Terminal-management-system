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
        Schema::create('maintenance_records', function (Blueprint $table) {
        
            $table->uuid('id')->primary();
            $table->foreignUuid('sensor_id')->nullable()->constrained('sensors')->nullOnDelete();
            $table->foreignUuid('tank_id')->nullable()->constrained('tanks')->nullOnDelete();
            $table->text('description');
            $table->date('maintenance_date');
            $table->string('performed_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_records');
    }
};
