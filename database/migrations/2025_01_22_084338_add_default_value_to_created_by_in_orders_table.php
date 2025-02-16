<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_default_value_to_created_by_in_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValueToCreatedByInOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->default(1)->change(); // Ganti 1 dengan nilai default yang diinginkan
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->change();
        });
    }
}