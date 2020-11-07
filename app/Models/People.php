<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'height', 'gender', 'homeworld_id'
    ];
    public function films()
    {
        return $this->hasMany(Movie::class);
    }

    public function homeworld()
    {
        return $this->belongsTo(Homeworld::class);
    }
}
