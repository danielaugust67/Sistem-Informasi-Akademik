<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentGrade extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['assessment_id', 'enrollment_id', 'score'];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}