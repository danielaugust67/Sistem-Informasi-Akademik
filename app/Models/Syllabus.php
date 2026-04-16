<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'syllabus';

    protected $fillable = ['subject_id', 'title', 'description', 'file_path'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}