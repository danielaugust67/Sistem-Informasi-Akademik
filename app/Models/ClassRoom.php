<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['subject_id', 'semester_id', 'rombel_id', 'capacity', 'room_code'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(TeacherProfile::class, 'class_room_teacher')
                    ->withPivot('is_primary');
    }
}