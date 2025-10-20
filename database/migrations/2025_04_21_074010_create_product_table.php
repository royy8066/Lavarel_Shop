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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('ten_sanpham');
            $table->decimal('giasp', 15, 2);
            $table->unsignedBigInteger('danhmuc_id');
            $table->string('img')->nullable();
            $table->text('mota')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('danhmuc_id')->references('id')->on('category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
