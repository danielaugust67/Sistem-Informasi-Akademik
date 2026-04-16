<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['student_id', 'class_room_id', 'status', 'enrolled_at'];

    protected $casts = [
        'enrolled_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(StudentProfile::class, 'student_id');
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function grades()
    {
        return $this->hasOne(Grade::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}