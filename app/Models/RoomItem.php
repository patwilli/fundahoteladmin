<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class RoomItem extends Model
{
    use HasFactory;
    protected $table = 'rooms_items';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'room_id', 'number', 'status'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
    public static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
