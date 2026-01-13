<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            // 1) order_id boleh null (supaya chat sebelum order bisa)
            $table->unsignedBigInteger('order_id')->nullable()->change();

            // 2) pastikan thread_key unique (supaya 1 buyer bisa chat beda seller / beda order)
            // kalau unique-nya sudah ada, bagian ini aman; kalau error duplicate index, lihat catatan di bawah.
            $table->string('thread_key', 191)->unique()->change();
        });

        // 3) kalau kamu MASIH punya unique lama: (order_id,buyer_id,seller_id)
        // lebih aman di-drop karena pre-chat order_id null bikin skema jadi “aneh” untuk ke depannya.
        Schema::table('conversations', function (Blueprint $table) {
            // nama index ini sesuai error/hasil SHOW CREATE TABLE kamu yang dulu:
            // conversations_order_id_buyer_id_seller_id_unique
            if (Schema::hasColumn('conversations', 'order_id')) {
                // dropUnique akan error kalau indexnya tidak ada; kalau kamu ragu, cek SHOW CREATE TABLE dulu.
                $table->dropUnique('conversations_order_id_buyer_id_seller_id_unique');
            }
        });
    }

    public function down(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            // balikkan perubahan (opsional)
            $table->dropUnique(['thread_key']);
            $table->unsignedBigInteger('order_id')->nullable(false)->change();

            // balikin unique lama
            $table->unique(['order_id','buyer_id','seller_id'], 'conversations_order_id_buyer_id_seller_id_unique');
        });
    }
};