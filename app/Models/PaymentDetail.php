<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['payment_id', 'item_name', 'amount'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}