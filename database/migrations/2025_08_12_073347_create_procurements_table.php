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
        Schema::create('procurements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('requested_by');
            $table->date('requested_at');
            $table->string('status')->default('pending');
            $table->decimal(column: 'amount', 35, 2)->nullable();
            $table->string('vendor')->nullable();
            $table->date('approved_at')->nullable();
            $table->string('approved_by')->nullable();
            $table->date('ordered_at')->nullable();
            $table->date('delivered_at')->nullable();
            $table->string('delivery_status')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurements');
    }
};
