<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offence extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'employee_id',
        'date',
        'offence_category',
        'offence_description',
        'image',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
