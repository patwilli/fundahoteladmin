<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'bookings';
    protected $fillable = [
        'room_id', 'user_id', 'checkin', 'checkout', 'price', 'payment_mode', 'booking_status', 'room_item_id'
    ];
    public static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function roomItem()
    {
        return $this->belongsTo(Room::class);
    }
    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}
