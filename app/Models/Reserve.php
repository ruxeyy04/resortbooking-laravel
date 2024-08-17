<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $primaryKey = 'reserve_id';
    protected $table = 'reserve';
    protected $fillable = ['account_id', 'resort_id', 'room_id', 'date_reserved'];

    public function account()
    {
        return $this->belongsTo(User::class);
    }

    public function resort()
    {
        return $this->belongsTo(Resort::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
