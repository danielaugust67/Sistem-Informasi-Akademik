<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['institution_id', 'academic_year_id', 'name', 'homeroom_teacher_id', 'capacity'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function homeroomTeacher()
    {
        return $this->belongsTo(TeacherProfile::class, 'homeroom_teacher_id');
    }
}