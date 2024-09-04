<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invoice extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'booking_id', 'user_id', 'inv_amount', 'inv_date', 'inv_status', 'admin_id'
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
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    public function Booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
