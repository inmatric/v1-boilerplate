<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationType extends Model
{
    // Nama tabel
    protected $table = 'location_type';

    // Kolom yang bisa diisi
    protected $fillable = [
        'location_type',
        'description'
    ];
}
