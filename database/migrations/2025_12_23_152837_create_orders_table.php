<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // buyer
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // nomor invoice simple
            $table->string('code')->unique();

            // status tracking
            $table->enum('status', ['pending', 'paid', 'packed', 'shipped', 'delivered', 'cancelled'])
                ->default('pending');

            // total
            $table->unsignedInteger('subtotal')->default(0);
            $table->unsignedInteger('shipping_fee')->default(0);
            $table->unsignedInteger('total')->default(0);

            // alamat & catatan
            $table->string('receiver_name');
            $table->string('phone', 30);
            $table->text('address');

            $table->text('note')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
