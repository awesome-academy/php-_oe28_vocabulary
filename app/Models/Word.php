<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Type;

class Word extends Model
{
    protected $fillable = [
        'word',
        'pronunciation',
        'meaning',
        'note',
        'sound',
        'photo',
        'type_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function types()
    {
        return $this->belongsTo(Type::class);    
    }
}
