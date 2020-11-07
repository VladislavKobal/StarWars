<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'people_id',
        'url',
    ];
    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
