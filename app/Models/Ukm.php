<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'email',
        'wa',
        'proposal_url',
        'pitch_deck_url',
        'category_id',
        'status',
    ];
}
