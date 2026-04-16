<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['enrollment_id', 'schedule_id', 'date', 'status', 'checked_at'];

    protected $casts = [
        'date' => 'date',
        'checked_at' => 'datetime',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}