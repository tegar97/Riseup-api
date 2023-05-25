<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable=[
        'service_name',
        'payment_code',
        'amount',
        'payment_url',
        'service_id'


    ];



}
