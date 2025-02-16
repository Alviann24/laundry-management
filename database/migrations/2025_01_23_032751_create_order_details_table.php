<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Menautkan ke tabel orders
            $table->foreignId('laundry_item_id')->constrained()->onDelete('cascade'); // Menautkan ke tabel laundry_items
            $table->integer('quantity')->default(1); // Jumlah item yang dipesan
            $table->float('kg')->nullable(); // Berat dalam kilogram, jika ada
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
