<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $guard = 'admins';
    protected $table = 'admins';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'name', 'email', 'phone', 'status', 'super_admin', 'password'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}
