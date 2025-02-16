<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('order_laundry_item', function (Blueprint $table) {
            $table->decimal('weight', 8, 2)->nullable()->after('quantity');
        });
    }
    
    public function down()
    {
        Schema::table('order_laundry_item', function (Blueprint $table) {
            $table->dropColumn('weight');
        });
    }
    
};
