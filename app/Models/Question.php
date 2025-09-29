<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['theme_id', 'content'];

    // Relation : une question appartient à un thème
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    // Relation : une question a plusieurs choix
    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
