<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['enrollment_id', 'total_score', 'letter_grade'];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}