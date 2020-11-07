<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homeworld extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'people_id',
    ];

    public function people()
    {
        return $this->hasOne(People::class);
    }
}
