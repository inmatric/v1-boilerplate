<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;

    protected $table = 'lost_items';

    protected $fillable = [
        'lost_name',
        'item_name',
        'lost_location',
        'lost_date',
        'photo',
        'status',
        'description',
    ];
}
