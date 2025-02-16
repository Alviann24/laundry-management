<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByToOrdersTable extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->after('id'); // Tambahkan kolom created_by
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade'); // Relasi ke tabel users
        });
    }

    /**
     * Rollback migration.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['created_by']); // Hapus foreign key
            $table->dropColumn('created_by'); // Hapus kolom
        });
    }
}
