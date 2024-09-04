<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'invoice_details';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'invoice_id',
        'libelle',
        'pu',
        'qte',
        'status',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
