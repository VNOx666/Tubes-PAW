<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1) drop FK order_id (karena kita mau ubah jadi nullable)
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
        });

        // 2) drop unique lama yang bikin order wajib
        DB::statement("ALTER TABLE conversations DROP INDEX conversations_order_id_buyer_id_seller_id_unique");

        // 3) ubah order_id jadi NULLABLE
        DB::statement("ALTER TABLE conversations MODIFY order_id BIGINT UNSIGNED NULL");

        // 4) tambah thread_key yang UNIQUE
        Schema::table('conversations', function (Blueprint $table) {
            $table->string('thread_key', 191)->unique()->after('seller_id');

            // FK order_id boleh null
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->nullOnDelete();
        });

        // 5) isi thread_key untuk data lama (yang sudah punya order)
        DB::statement("UPDATE conversations SET thread_key = CONCAT('ord:', order_id, ':', seller_id) WHERE thread_key IS NULL");
    }

    public function down(): void
    {
        // rollback kasar (opsional)
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropUnique(['thread_key']);
            $table->dropColumn('thread_key');
        });

        DB::statement("ALTER TABLE conversations MODIFY order_id BIGINT UNSIGNED NOT NULL");

        Schema::table('conversations', function (Blueprint $table) {
            $table->unique(['order_id', 'buyer_id', 'seller_id']);
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->cascadeOnDelete();
        });
    }
};
