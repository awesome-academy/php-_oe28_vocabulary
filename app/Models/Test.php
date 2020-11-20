<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Word;

class Test extends Model
{
    protected $fillable = [
        'test',
        'option_level',
        'score',
        'total',
        'timeout',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function words()
    {
        return $this->belongsToMany(Word::class)->withPivot('answer', 'is_true', 'type_id');
    }
}
