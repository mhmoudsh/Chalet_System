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
        Schema::create('user_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('status')->default(1);
            $table->string('date');
            $table->unsignedBigInteger('interval_id')->nullable();
            $table->foreign('interval_id')->references('id')->on('intervals')->onDelete('cascade');
            $table->string('start_custom_time')->nullable();
            $table->string('end_custom_time')->nullable();
            $table->decimal('basic_price',8,2);
            $table->decimal('manual_price',8,2);
            $table->decimal('amount_paid',8,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reservations');
    }
};
