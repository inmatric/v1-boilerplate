<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    /** @use HasFactory<\Database\Factories\AttendanceFactory> */
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'date',
        'start_time',
        'end_time',
        'photo',
        'end_photo',
        'notes',
        'status',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
