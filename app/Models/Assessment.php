<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['class_room_id', 'name', 'weight'];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }
}