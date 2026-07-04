<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notification_logs', function (Blueprint $table) {
            $table->string('provider')->nullable()->change();
            $table->string('provider_message_id')->nullable()->change();
            $table->json('response')->nullable()->change();
            $table->text('error_message')->nullable()->change();
            $table->timestamp('processed_at')->nullable()->change();
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE notification_logs MODIFY COLUMN status ENUM('pending', 'success', 'failed', 'retry') NOT NULL DEFAULT 'pending'");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE notification_logs MODIFY COLUMN status ENUM('success', 'failed', 'retry') NOT NULL");
        }

        Schema::table('notification_logs', function (Blueprint $table) {
            $table->string('provider')->nullable(false)->change();
            $table->string('provider_message_id')->nullable(false)->change();
            $table->json('response')->nullable(false)->change();
            $table->text('error_message')->nullable(false)->change();
            $table->timestamp('processed_at')->nullable(false)->change();
        });
    }
};
