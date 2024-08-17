<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resort extends Model
{
    use HasFactory;

    protected $primaryKey = 'resort_id';
    public $timestamp = true;
    protected $fillable = ['resort_name', 'location', 'resort_description', 'price', 'image'];
    
}
