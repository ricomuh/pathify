<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
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
            // ->orderBy('order', 'asc')
            ->inRandomOrder()
            ->with(['answers' => function ($query) {
                $query->select('id', 'questionnaire_question_id', 'answer');
                $query->inRandomOrder();
            }])
            ->get();

        // return response()->json(data: $questionnaireQuestions);
        return Inertia::render('Questionnaire/Index', compact('questionnaireQuestions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*.id' => 'required|exists:questionnaire_answers,id',
            // 'answers.*.answer' => 'required|string',
        ]);

        $categories = Category::whereNull('parent_id')->get();

        $answers = QuestionnaireAnswer::
            // whereIn('questionnaire_question_id', collect($request->answers)->pluck('questionnaire_question_id'))
            // ->whereIn('answer', collect($request->answers)->pluck('answer'))
            with([
                'scores' => function ($query) {
                    // $query->with('category');
                }
            ])
            ->get();
        //

        $answers->each(function ($answer) use ($categories) {
            $answer->scores->each(function ($score) use ($categories) {
                $category = $categories->firstWhere('id', $score->category_id);
                $category->max_score += $score->score;
            });
        });

        $userAnswers = collect($request->answers);

        $answers->filter(function ($answer) use ($userAnswers) {
            return $userAnswers->contains('id', $answer->id);
        })->each(function ($answer) use ($categories, $userAnswers) {
            $answer->scores->each(function ($score) use ($categories, $answer, $userAnswers) {
                $category = $categories->firstWhere('id', $score->category_id);
                $category->rawScore += $score->score; // * $userAnswers->firstWhere('id', $answer->id)->answer;
                $category->score = $category->rawScore / $category->max_score * 100;
            });
        });

        // dd($answers, $userAnswers, $categories);


        // get the 2 highest value
        $highest = $categories->sortByDesc(function ($category) {
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
            'result' => $categories->mapWithKeys(function ($category) {
                // return [$category->name => $category->score];
                return [$category->name => [
                    'score' => $category->score,
                    // 'raw_score' => $category->rawScore,
                    // 'max_score' => $category->max_score,
                    'color' => $category->color,
                ]];
            }),
            'questionnaire_result_category_id' => $questionnaireCategory ? $questionnaireCategory->id : null,
            '1st_category_id' => $firstHighest->id,
            '2nd_category_id' => $secondHighest ? $secondHighest->id : null,
        ]);


        // insert the answer to the database
        // QuestionnaireResult::create

        // return response()->json($categoryScores);

        // return response()->json(compact('categoryScores', 'questionnaireCategory'));
        return redirect()->route('questionnaire.show', $questionnaireResult);
    }

    public function show(QuestionnaireResult $questionnaireResult)
    {
        $questionnaireResult->load([
            'user',
            'category',
            'firstCategory',
            'secondCategory',
        ]);

        // if (auth()-user()) {
        // load courses related to the first and second category
        $categories = [$questionnaireResult->firstCategory->id];
        if ($questionnaireResult->secondCategory) {
            $categories[] = $questionnaireResult->secondCategory->id;
        }
        // }

        $relatedCourses = Course::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.id', $categories);
        })
            ->with([
                'mentor' => function ($query) {
                    $query->select('id', 'profile_picture', 'fullname', 'username');
                    $query->with('mentorDetail');
                },
                'categories' => function ($query) {
                    $query->whereNull('parent_id');
                },
            ])
            ->published()
            ->inRandomOrder()
            ->limit(6)
            ->get();
        // $relatedCourses = [];

        // return response()->json(compact('questionnaireResult', 'relatedCourses'));
        return Inertia::render('Questionnaire/Result', compact('questionnaireResult', 'relatedCourses'));
    }
}
