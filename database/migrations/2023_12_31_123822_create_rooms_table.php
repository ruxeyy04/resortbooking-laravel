<?php

use App\Models\Room;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('room_id');
            $table->string('room_name');
            $table->text('room_description');
            $table->timestamps();
        });

        $roomsData = [
            [
                'room_id' => 1,
                'room_name' => 'Grand Room',
                'room_description' => 'Consists of 2 king beds and 3 double beds.',
            ],
            [
                'room_id' => 2,
                'room_name' => 'Luxury Room',
                'room_description' => 'Consists of 1 king bed, 2 double beds, and 3 single beds.',
            ],
            [
                'room_id' => 3,
                'room_name' => 'Ball Room',
                'room_description' => 'This room consists of a ball room',
            ],
            [
                'room_id' => 5,
                'room_name' => 'Golden de Marky',
                'room_description' => 'Has 30 queens bed and 20 kings bed and unlimited toilet paper',
            ],
        ];
        
        Room::insert($roomsData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
