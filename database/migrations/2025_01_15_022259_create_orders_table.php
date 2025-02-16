<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    
        // Buat tabel pivot untuk banyak ke banyak (Many to Many)
        Schema::create('laundry_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('laundry_item_id')->constrained('laundry_items')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->decimal('kg', 8, 2)->default(0);
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->after('id'); // Menambahkan kolom created_by
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade'); // Relasi ke tabel users
        });

        
    }
    
    
    public function down()
    {
        Schema::dropIfExists('order_laundry_item');
    }
};
