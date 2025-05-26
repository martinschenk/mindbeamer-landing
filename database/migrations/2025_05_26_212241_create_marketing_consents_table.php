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
        Schema::create('marketing_consents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->index();
            $table->boolean('consent_given')->default(false);
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('form_type')->default('contact');
            $table->text('consent_text')->nullable();
            $table->string('locale', 10)->nullable();
            $table->timestamps();
            
            // Index für schnellere Abfragen
            $table->index(['email', 'consent_given']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_consents');
    }
};
