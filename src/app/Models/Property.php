<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'address',
        'bedrooms',
        'bathrooms',
        'total_area',
        'purchased',
        'value',
        'discount',
        'owner_id',
        'expired'
    ];

    protected $hidden = ['deleted_at'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
