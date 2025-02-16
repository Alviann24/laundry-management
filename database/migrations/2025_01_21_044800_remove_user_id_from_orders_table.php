<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menghapus foreign key constraint terlebih dahulu
            $table->dropForeign(['user_id']);
            // Kemudian baru hapus kolom user_id
            $table->dropColumn('user_id');
        });
    }
    
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menambahkan kembali kolom user_id
            $table->unsignedBigInteger('user_id')->nullable();
            // Menambahkan kembali foreign key constraint
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    
    
};
