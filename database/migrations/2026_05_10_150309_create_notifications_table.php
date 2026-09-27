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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('user_id')->index()->constrained(table: 'users')->cascadeOnDelete();
            $table->foreignId('template_id')->index()->constrained(table: 'notification_templates');
            $table->enum('status', ['pending', 'queued', 'processing', 'sent', 'failed', 'read', 'cancelled'])->index()->default('pending');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->index()->default('medium');
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable();
            $table->timestamp('scheduled_at')->nullable()->index();
            $table->timestamp('queued_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('failed_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
