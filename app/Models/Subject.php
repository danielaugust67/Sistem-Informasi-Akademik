<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['institution_id', 'curriculum_id', 'study_program_id', 'code', 'name', 'credit_hours', 'level'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function prerequisites()
    {
        return $this->belongsToMany(Subject::class, 'subject_prerequisites', 'subject_id', 'required_subject_id')
                    ->withPivot('minimum_grade');
    }
}