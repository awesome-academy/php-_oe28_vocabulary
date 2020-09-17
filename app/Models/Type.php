<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Word;

class Type extends Model
{
    protected $fillable = [
        'type',
        'description',
    ];

    public function words()
    {
        return $this->belongsToMany(Word::class);    
    }
}
