<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    /** @use HasFactory<\Database\Factories\FundFactory> */
    use HasFactory;
    protected $table = 'funds';

    // Kolom yang boleh diisi
    protected $fillable = [
        'cooperation_id',
        'date',
        'fund_received',
        'payment',
        'receipt',
        'description',
    ];
}
