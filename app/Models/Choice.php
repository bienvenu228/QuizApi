<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'content', 'is_correct'];

    // Relation : un choix appartient à une question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
