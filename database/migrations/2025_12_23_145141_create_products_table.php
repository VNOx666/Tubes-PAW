<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // seller pemilik barang
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            $table->unsignedInteger('price'); // rupiah
            $table->text('description')->nullable();

            $table->string('category')->nullable(); // hoodie, jacket, jeans, dll
            $table->string('grade', 5)->nullable(); // A/B/C
            $table->string('size', 30)->nullable(); // S/M/L/XL, dll
            $table->string('color', 50)->nullable();

            // barang thrifting biasanya 1 item
            $table->unsignedSmallInteger('quantity')->default(1);

            // status jual
            $table->enum('status', ['active', 'sold', 'draft'])->default('active');

            // foto utama
            $table->string('image')->nullable(); // path di storage

            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['name', 'category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
