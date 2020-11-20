<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Word;

class Type extends Model
{
    public function words()
    {
        return $this->belongsToMany(Word::class)->withPivot('meaning');    
    }
}
