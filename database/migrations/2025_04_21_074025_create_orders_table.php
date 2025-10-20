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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('fullname');
            $table->string('email');
            $table->string('sdt', 10);
            $table->string('diachi');
            $table->decimal('tongtien', 15, 2);
            $table->string('payment_method');
            $table->string('trang_thai')->default('Chờ xác nhận');
            $table->string('vnpay_txn_ref')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('login')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
