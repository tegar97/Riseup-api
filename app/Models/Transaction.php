<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'funding_id',
        'payment_id',
        'amount',
        'status'

    ];

    public function payments() {
        return $this->belongsTo(Payment::class);
    }
}
