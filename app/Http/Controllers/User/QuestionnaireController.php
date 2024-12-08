<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\QuestionnaireAnswer;
use App\Models\QuestionnaireAnswerScore;
use App\Models\QuestionnaireQuestion;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function index()
    {
        $questionnaireQuestions = QuestionnaireQuestion::select('id', 'order', 'question')
            ->orderBy('order', 'asc')
            ->with(['answers' => function ($query) {
                $query->select('id', 'questionnaire_question_id', 'answer');
            }])
            ->get();

        return response()->json($questionnaireQuestions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*.id' => 'required|exists:questionnaire_questions,id',
            // 'answers.*.answer' => 'required|string',
        ]);

        $categories = Category::whereNull('parent_id')->get();

        $answerScores = QuestionnaireAnswer::
            // whereIn('questionnaire_question_id', collect($request->answers)->pluck('questionnaire_question_id'))
            // ->whereIn('answer', collect($request->answers)->pluck('answer'))
            with([
                'scores' => function ($query) {
                    // $query->with('category');
                }
            ])
            ->get();
        //

        $answerScores->each(function ($answerScore) use ($categories) {
            $answerScore->scores->each(function ($score) use ($categories) {
                $category = $categories->firstWhere('id', $score->category_id);
                $category->max_score += $score->score;
            });
        });

        // now we have the max score for each category
        // now, let's calculate all of the answer scores, that included in the request, and calculate the total score for each category, and then calculate the percentage
        $totalScores = collect($request->answers)->reduce(function ($carry, $answer) use ($answerScores) {
            $answerScore = $answerScores->firstWhere('questionnaire_question_id', $answer['id']);
            $score = $answerScore->scores->firstWhere('category_id', $answer['category_id']);

            $carry[$answer['category_id']] += $score->score;

            return $carry;
        }, $categories->pluck('max_score')->mapWithKeys(function ($maxScore, $categoryId) {
            return [$categoryId => 0];
        })->toArray());
        // $totalScores = collect($request->answers)->reduce(function ($carry, $answer) use ($answerScores) {
        //     $answerScore = $answerScores->firstWhere('questionnaire_question_id', $answer['questionnaire_question_id']);
        //     $score = $answerScore->scores->firstWhere('category_id', $answer['category_id']);

        //     $carry[$answer['category_id']] += $score->score;

        //     return $carry;
        // }, $categories->pluck('max_score')->mapWithKeys(function ($maxScore, $categoryId) {
        //     return [$categoryId => 0];
        // })->toArray());

        $totalMaxScores = $categories->pluck('max_score')->sum();

        $categoryScores = $categories->map(function ($category) use ($totalScores, $totalMaxScores) {
            $category->score = $totalScores[$category->id];
            $category->percentage = $totalMaxScores > 0 ? $category->score / $totalMaxScores * 100 : 0;

            return $category;
        });

        return response()->json($categoryScores);
    }
}
