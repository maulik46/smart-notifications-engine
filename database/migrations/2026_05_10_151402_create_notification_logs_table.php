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
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')->index()->constrained(table: 'notifications')->cascadeOnDelete();
            $table->enum('status', ['success','failed','retry'])->index();
            $table->string('provider');
            $table->string('provider_message_id');
            $table->integer('attempt')->default(1);
            $table->json('response');
            $table->text('error_message');
            $table->timestamp('processed_at')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
    }
};
