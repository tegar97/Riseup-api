<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    use HasFactory;



    public function ukm()
    {
        return $this->belongsTo(Ukm::class);
    }
}
