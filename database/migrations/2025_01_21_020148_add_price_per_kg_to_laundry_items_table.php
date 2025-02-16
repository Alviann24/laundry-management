<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('laundry_items', function (Blueprint $table) {
            $table->decimal('price_per_kg', 10, 2)->nullable()->after('price')->comment('Harga per kilogram');
        });
    }
    
    public function down()
    {
        Schema::table('laundry_items', function (Blueprint $table) {
            $table->dropColumn('price_per_kg');
        });
    }
    
};
