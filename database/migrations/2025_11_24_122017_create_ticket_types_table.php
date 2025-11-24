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
      Schema::create('ticket_types', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('concert_id');
    $table->string('name');
    $table->integer('price');
    $table->integer('quota');
    $table->integer('sold')->default(0);
    $table->timestamps();

    $table->foreign('concerts_id')->references('id')->on('concerts')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }

    
};
