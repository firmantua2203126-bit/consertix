<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('ticket_types', function (Blueprint $table) {
        $table->unsignedBigInteger('concert_id')->after('id');

        $table->foreign('concert_id')
            ->references('id')->on('concerts')
            ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('ticket_types', function (Blueprint $table) {
        $table->dropForeign(['concert_id']);
        $table->dropColumn('concert_id');
    });
}

};
