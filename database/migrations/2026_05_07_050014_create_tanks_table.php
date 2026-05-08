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
        Schema::create('tanks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('terminal_id')->constrained('terminals')->cascadeOnDelete();  
            $table->string('name');
            $table->string('tank_number')->unique();
            $table->string('fuel_type');
            $table->decimal('capacity_liters', 15, 2);
            $table->decimal('safe_level', 15, 2);
            $table->decimal('critical_level', 15, 2);
            $table->decimal('current_volume', 15, 2)->default('0');
            $table->enum('status', ['active', 'inactive','maintenance'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanks');
    }
};




