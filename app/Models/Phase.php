<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'level', 'points_weight'];

    // Relation : une phase a plusieurs thèmes
    public function themes()
    {
        return $this->hasMany(Theme::class);
    }
}
