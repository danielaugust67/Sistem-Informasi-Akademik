<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['student_id', 'semester_id', 'total_amount', 'status', 'invoice_no'];

    public function student()
    {
        return $this->belongsTo(StudentProfile::class, 'student_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function details()
    {
        return $this->hasMany(PaymentDetail::class);
    }
}