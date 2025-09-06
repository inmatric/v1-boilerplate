<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintResolution extends Model
{
    use HasFactory;

    protected $table = 'complaint_resolution';

    protected $fillable = [
        'date',
        'employee_id',
        'complaint_id',
        'doings',
        'photo_evidence',
        'location_id',
        'notes',
    ];

    // Relasi ke Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Relasi ke Complaint
    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    // Relasi ke Location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
