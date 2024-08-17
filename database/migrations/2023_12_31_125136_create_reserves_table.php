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
        Schema::create('reserve', function (Blueprint $table) {
            $table->increments('reserve_id');
            $table->unsignedInteger('resort_id');
            $table->unsignedInteger('room_id');
            $table->unsignedInteger('account_id');
            $table->date('date_reserved')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('resort_id')->references('resort_id')->on('resorts');
            $table->foreign('room_id')->references('room_id')->on('rooms');
            $table->foreign('account_id')->references('account_id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserves');
    }
};
