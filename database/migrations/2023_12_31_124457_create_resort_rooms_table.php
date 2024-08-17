<?php

use App\Models\ResortRoom;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resort_room', function (Blueprint $table) {
            $table->increments('resort_room_id');
            $table->unsignedInteger('resort_id');
            $table->unsignedInteger('room_id');
            $table->enum('status', ['not_booked', 'booked'])->default('not_booked');
            $table->timestamps();

            $table->foreign('resort_id')->references('resort_id')->on('resorts')->onDelete('cascade');
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
        });

        ResortRoom::insert([
            ['resort_room_id' => 40, 'resort_id' => 4, 'room_id' => 1, 'status' => 'not_booked'],
            ['resort_room_id' => 41, 'resort_id' => 4, 'room_id' => 2, 'status' => 'not_booked'],
            ['resort_room_id' => 42, 'resort_id' => 4, 'room_id' => 3, 'status' => 'not_booked'],
            ['resort_room_id' => 43, 'resort_id' => 4, 'room_id' => 5, 'status' => 'not_booked'],
            ['resort_room_id' => 44, 'resort_id' => 5, 'room_id' => 1, 'status' => 'not_booked'],
            ['resort_room_id' => 45, 'resort_id' => 5, 'room_id' => 2, 'status' => 'not_booked'],
            ['resort_room_id' => 46, 'resort_id' => 5, 'room_id' => 3, 'status' => 'not_booked'],
            ['resort_room_id' => 47, 'resort_id' => 5, 'room_id' => 5, 'status' => 'not_booked'],
            ['resort_room_id' => 48, 'resort_id' => 3, 'room_id' => 1, 'status' => 'not_booked'],
            ['resort_room_id' => 49, 'resort_id' => 3, 'room_id' => 2, 'status' => 'not_booked'],
            ['resort_room_id' => 50, 'resort_id' => 3, 'room_id' => 3, 'status' => 'not_booked'],
            ['resort_room_id' => 51, 'resort_id' => 3, 'room_id' => 5, 'status' => 'not_booked'],
            ['resort_room_id' => 52, 'resort_id' => 1, 'room_id' => 1, 'status' => 'not_booked'],
            ['resort_room_id' => 53, 'resort_id' => 1, 'room_id' => 2, 'status' => 'not_booked'],
            ['resort_room_id' => 54, 'resort_id' => 1, 'room_id' => 3, 'status' => 'not_booked'],
            ['resort_room_id' => 55, 'resort_id' => 1, 'room_id' => 5, 'status' => 'not_booked'],
            ['resort_room_id' => 56, 'resort_id' => 2, 'room_id' => 1, 'status' => 'not_booked'],
            ['resort_room_id' => 57, 'resort_id' => 2, 'room_id' => 2, 'status' => 'not_booked'],
            ['resort_room_id' => 58, 'resort_id' => 2, 'room_id' => 3, 'status' => 'not_booked'],
            ['resort_room_id' => 59, 'resort_id' => 2, 'room_id' => 5, 'status' => 'not_booked'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resort_room');
    }
};
