<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id', 'nis_nim', 'study_program_id', 'rombel_id', 
        'academic_advisor_id', 'status', 'enrolled_at'
    ];

    protected $casts = [
        'enrolled_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }

    public function academicAdvisor()
    {
        return $this->belongsTo(TeacherProfile::class, 'academic_advisor_id');
    }
}