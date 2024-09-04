<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Room extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'rooms';
    protected $fillable = [
        'room_name', 'no_of_beds', 'room_qty', 'description', 'price', 'room_image', 'status'
    ];
    public static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
    public function roomItem()
    {
        return $this->hasMany(RoomItem::class);
    }
}
