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
    $table->unsignedBigInteger('user_id');
 $table->unsignedBigInteger('concert_id');
    $table->string('buyer_name');
    $table->string('buyer_email');
    $table->integer('total_amount');
    $table->string('status')->default('pending');
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users');
$table->foreign('concert_id')->references('id')->on('concerts');

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
