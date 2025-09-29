<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'question_id', 'choice_id'];

    // Relation : une réponse appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation : une réponse appartient à une question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relation : une réponse référence un choix
    public function choice()
    {
        return $this->belongsTo(Choice::class);
    }
}
