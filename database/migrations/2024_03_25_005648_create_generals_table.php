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
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('inside')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('schedule')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('support_one')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('support_two')->nullable();
            $table->string('whatsapp2')->nullable();
            $table->string('form_email')->nullable();
            $table->string('business_hours')->nullable();
            $table->string('mensaje_whatsapp')->nullable();
            $table->text('aboutus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generals');
    }
};
