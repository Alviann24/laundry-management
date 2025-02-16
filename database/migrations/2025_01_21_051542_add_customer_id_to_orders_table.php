<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menambahkan kolom customer_id
            $table->unsignedBigInteger('customer_id')->nullable(); // Menambahkan kolom customer_id
            // Menambahkan foreign key constraint
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menghapus kolom dan foreign key jika rollback migration
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
        });
    }
}
