<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['phase_id', 'title'];

    // Relation : un thème appartient à une phase
    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    // Relation : un thème a plusieurs questions
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
