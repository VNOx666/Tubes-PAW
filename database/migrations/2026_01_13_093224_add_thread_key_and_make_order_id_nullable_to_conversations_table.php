<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            // 1) tambah thread_key
            if (!Schema::hasColumn('conversations', 'thread_key')) {
                $table->string('thread_key', 50)->nullable()->after('id');
                $table->unique('thread_key');
            }

            // 2) order_id dibuat nullable (biar pre-chat bisa)
            // NOTE: kalau change() error, baca bagian "Kalau change() error" di bawah
            $table->unsignedBigInteger('order_id')->nullable()->change();

            // 3) Unique lama yang pakai order_id sering bikin ribet untuk pre-chat
            // (karena order_id null / order_id wajib, dsb).
            // Aman untuk dihapus, karena kita pakai unique thread_key.
            $table->dropUnique('conversations_order_id_buyer_id_seller_id_unique');
        });
    }

    public function down(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            // balikin unique lama (opsional)
            $table->unique(['order_id', 'buyer_id', 'seller_id'], 'conversations_order_id_buyer_id_seller_id_unique');

            // balikin order_id not null (opsional)
            $table->unsignedBigInteger('order_id')->nullable(false)->change();

            // hapus thread_key
            if (Schema::hasColumn('conversations', 'thread_key')) {
                $table->dropUnique(['thread_key']);
                $table->dropColumn('thread_key');
            }
        });
    }
};