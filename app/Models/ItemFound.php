<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemFound extends Model
{
    use HasFactory;

    protected $table = 'item_found';

    protected $fillable = [
        'find_name',
        'item_name',
        'find_location',
        'find_date',
        'telephone',
        'photo',
        'status',
        'description',
    ];
}
