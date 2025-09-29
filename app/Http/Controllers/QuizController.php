<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phase;
use App\Models\Theme;
use App\Models\Question;
use App\Models\Choice;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // Récupérer toutes les phases
    public function phases()
    {
        return response()->json(Phase::all());
    }

    // Récupérer les questions et choix d’un thème
    public function questions($themeId)
    {
        $theme = Theme::with('questions.choices')->findOrFail($themeId);
        return response()->json($theme->questions);
    }

    // Enregistrer les réponses d’un utilisateur
    public function storeAnswers(Request $request)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.choice_id' => 'required|exists:choices,id'
        ]);

        $user = Auth::user();

        foreach ($request->answers as $answer) {
            UserAnswer::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'question_id' => $answer['question_id']
                ],
                [
                    'choice_id' => $answer['choice_id']
                ]
            );
        }

        return response()->json(['message' => 'Réponses enregistrées']);
    }

    // Statistiques de l’utilisateur
    public function stats()
    {
        $user = Auth::user();
        $answers = UserAnswer::with('choice')->where('user_id', $user->id)->get();

        $score = 0;
        foreach ($answers as $answer) {
            if ($answer->choice->is_correct) {
                $score++;
            }
        }

        return response()->json([
            'user' => $user,
            'score' => $score,
            'total_questions' => $answers->count()
        ]);
    }
}
