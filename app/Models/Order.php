<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'books',
        'name_customer',
        'name_author',
    ];

    protected $casts = [
        'books' => 'array',
    ];
}
