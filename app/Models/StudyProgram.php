<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['department_id', 'code', 'name', 'level'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}