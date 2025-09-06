<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'visitor_name', 'customer_phone', 'description', 'proof_image',
        'status', 'location_id', 'employee_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }    

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}