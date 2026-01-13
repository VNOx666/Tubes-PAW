<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // 1) Tambah thread_key dulu (nullable sementara biar aman untuk data lama)
        Schema::table('conversations', function (Blueprint $table) {
            if (!Schema::hasColumn('conversations', 'thread_key')) {
                $table->string('thread_key', 191)->nullable()->after('seller_id');
            }
        });

        // 2) Backfill thread_key untuk data yang sudah ada (kalau ada)
        DB::table('conversations')->whereNull('thread_key')->orderBy('id')->chunkById(200, function ($rows) {
            foreach ($rows as $c) {
                $key = $c->order_id
                    ? "ord:{$c->order_id}:{$c->buyer_id}:{$c->seller_id}"
                    : "pre:{$c->buyer_id}:{$c->seller_id}";

                DB::table('conversations')->where('id', $c->id)->update(['thread_key' => $key]);
            }
        });

        // 3) Ubah order_id jadi nullable (BUTUH doctrine/dbal untuk ->change())
        Schema::table('conversations', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable()->change();
        });

        // 4) Hapus unique lama (order_id,buyer_id,seller_id) karena sekarang pakai thread_key
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropUnique('conversations_order_id_buyer_id_seller_id_unique');
        });

        // 5) Jadikan thread_key NOT NULL + UNIQUE
        Schema::table('conversations', function (Blueprint $table) {
            $table->string('thread_key', 191)->nullable(false)->change();
            $table->unique('thread_key');
        });
    }

    public function down(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            // balikin unique lama
            $table->unique(['order_id', 'buyer_id', 'seller_id'], 'conversations_order_id_buyer_id_seller_id_unique');

            // hapus unique thread_key
            $table->dropUnique(['thread_key']);

            // drop kolom thread_key
            if (Schema::hasColumn('conversations', 'thread_key')) {
                $table->dropColumn('thread_key');
            }

            // balikin order_id jadi NOT NULL
            $table->unsignedBigInteger('order_id')->nullable(false)->change();
        });
    }
};