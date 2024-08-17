<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResortRoom extends Model
{
    use HasFactory;

    protected $table = 'resort_room';
    protected $primaryKey = 'resort_room_id';
    public $timestamps = true;

    protected $fillable = [
        'resort_id',
        'room_id',
        'status',
    ];

    // Define relationships
    public function resort()
    {
        return $this->belongsTo(Resort::class, 'resort_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
