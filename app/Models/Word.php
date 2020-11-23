<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Type;

class Word extends Model
{
    protected $fillable = [
        'word',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class)->withPivot('meaning');    
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class)->withPivot('answer', 'is_true', 'type_id');
    }

    public function setWordAttribute($word)
    {
        $this->attributes['word'] = strtoupper($word);
    }
}
