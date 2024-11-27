<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'category',
        'rating',
        'sold',
        'stock',
        'user_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'sold' => 'integer',
        'stock' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
