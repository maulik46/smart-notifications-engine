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
        Schema::create('user_notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained(table: 'users')->cascadeOnDelete();
            $table->boolean('email_enabled')->default(false);
            $table->boolean('sms_enabled')->default(false);
            $table->boolean('push_enabled')->default(false);
            $table->boolean('marketing_enabled')->default(false);
            $table->boolean('order_updates_enabled')->default(false);
            $table->boolean('security_alert_enabled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_notification_preferences');
    }
};
