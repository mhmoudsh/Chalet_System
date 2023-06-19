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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_logo')->default('Center');
            $table->string('website_title')->default('Center');
            $table->string('phone')->default('05964589');
            $table->string('phone2')->default('343434');
            $table->string('website_email')->default('ah@gmil.com');
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('another_link')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('address')->nullable();
            $table->text('initial_message')->nullable();
            $table->text('confirm_message')->nullable();
            $table->text('cancel_message')->nullable();
            $table->string('cancel_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
