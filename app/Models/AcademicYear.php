<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['institution_id', 'year', 'status'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }
}