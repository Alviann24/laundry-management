<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('laundry_items', function (Blueprint $table) {
            $table->string('image')->nullable(); // Menambahkan kolom image
        });

        Schema::table('laundry_items', function (Blueprint $table) {
            $table->decimal('price_per_kg', 8, 2)->nullable()->after('price');
        });
        
    }
    
    public function down()
    {
        Schema::table('laundry_items', function (Blueprint $table) {
            $table->dropColumn('image'); // Menghapus kolom image jika rollback migrasi
        });

        Schema::table('laundry_items', function (Blueprint $table) {
            $table->decimal('price_per_kg', 8, 2)->nullable()->after('price');
        });
        
    }
    
};
