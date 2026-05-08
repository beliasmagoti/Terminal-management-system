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
        Schema::create('fuel_transfers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('from_tank_id')->references('id')->on('tanks')->cascadeOnDelete();
            $table->foreignUuid('to_tank_id')->references('id')->on('tanks')->cascadeOnDelete();
            $table->decimal('quantity_liters', 15, 2);
            $table->string('transfer_type');
            $table->string('transfer_by');
            $table->timestamp('transferred_at');
            $table->enum('status', ['active', 'completed', 'pending']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_transfers');
    }
};
