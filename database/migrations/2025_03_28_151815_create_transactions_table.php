<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('outlet_id');
        $table->foreignId('member_id');
        $table->string('invoice_code');
        $table->enum('status',['baru','proses','selesai','belum_dibayar']);

        $table->date('tanggal');
        $table->date('batas_waktu')->nullable();
        $table->enum('dibayar',['lunas','belum_dibayar']);
        $table->integer('diskon')->nullable()->default(0);
        $table->double('total_harga');
        $table->date('tanggal_bayar')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
