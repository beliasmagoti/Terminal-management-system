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
        Schema::create('fuel_deliveries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('terminal_id')->constrained('terminals')->cascadeOnDelete();
            $table->foreignUuid('tank_id')->constrained('tanks')->cascadeOnDelete();
            $table->string('supplier_name');
            $table->string('fuel_type');
            $table->decimal('density', 15, 2);
            $table->decimal('temperature_celsius', 15, 2);
            $table->decimal('quantity_liters', 15, 2);
            $table->string('delivery_reference')->unique();
            $table->timestamp('delivered_at');
            $table->string('received_by');
            $table->enum('status', ['completed', 'pending', 'active']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_deliveries');
    }
};
