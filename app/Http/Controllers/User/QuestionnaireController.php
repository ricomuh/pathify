<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\QuestionnaireAnswer;
use App\Models\QuestionnaireAnswerScore;
use App\Models\QuestionnaireQuestion;
use App\Models\QuestionnaireResult;
use App\Models\QuestionnaireResultCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

        // return response()->json(data: $questionnaireQuestions);
        return Inertia::render('Questionnaire/Index', compact('questionnaireQuestions'));
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

        // get the 2 highest value
        $highest = $categoryScores->sortByDesc(function ($category) {
            return $category->score;
        })->take(2);

        $firstHighest = $highest->first();

        $secondHighest = $highest->count() > 1 && abs($highest->last()->score - $firstHighest->score) < 10
            ? $highest->last()
            : null;

        $questionnaireCategory = QuestionnaireResultCategory::where([
            '1st_category_id' => $firstHighest->id,
            '2nd_category_id' => $secondHighest ? $secondHighest->id : null,
        ]);

        if (!$questionnaireCategory->exists() && $secondHighest) {
            $questionnaireCategory = QuestionnaireResultCategory::where([
                '1st_category_id' => $secondHighest->id,
                '2nd_category_id' => $firstHighest->id,
            ]);
        }

        if (!$questionnaireCategory->exists()) {
            $questionnaireCategory = QuestionnaireResultCategory::where([
                '1st_category_id' => $firstHighest->id,
            ]);
        }

        $questionnaireCategory = $questionnaireCategory->first();

        $questionnaireResult = QuestionnaireResult::create([
            'user_id' => auth()->id(),
            'result' => $categoryScores->mapWithKeys(function ($category) {
                return [$category->name => $category->score];
            }),
            'questionnaire_result_category_id' => $questionnaireCategory ? $questionnaireCategory->id : null,
            '1st_category_id' => $firstHighest->id,
            '2nd_category_id' => $secondHighest ? $secondHighest->id : null,
        ]);


        // insert the answer to the database
        // QuestionnaireResult::create

        // return response()->json($categoryScores);

        return response()->json(compact('categoryScores', 'questionnaireCategory'));
    }
}