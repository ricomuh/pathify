<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\QuestionnaireResultCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuestionnaireResult>
 */
class QuestionnaireResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::whereNull('parent_id')->get();

        $categories = $categories->map(function ($category) {
            // return [
            //     $category->name  => $this->faker->numberBetween(0, 100),
            // ];
            $category->score = $this->faker->numberBetween(0, 100);

            return $category;
        });

        $result = $categories->map(function ($category) {
            return [
                $category->name => $category->score,
            ];
        });
        // get the 2 highest value
        // $highest = $categories->sortByDesc(function ($category) {
        //     return array_values($category)[0];
        // })->take(2);

        // $firstHighest = $highest->first();
        // // only if the 2nd highest value is almost the same as the highest value (difference < 10)
        // $secondHighest = $highest->count() > 1 && abs(array_values($highest->last())[0] - array_values($firstHighest)[0]) < 10
        //     ? $highest->last()
        //     : null;

        // get the 2 highest value
        $highest = $categories->sortByDesc(function ($category) use ($result) {
            return $category->score;
        })->take(2);

        $firstHighest = $highest->first();

        $secondHighest = $highest->count() > 1 && abs($highest->last()->score - $firstHighest->score) < 10
            ? $highest->last()
            : null;

        $questionnaireCategory = QuestionnaireResultCategory::where([
            '1st_category_id' => $firstHighest->id,
            '2nd_category_id' => $secondHighest ? $secondHighest->id : null,
        ])->first();

        if (!$questionnaireCategory && $secondHighest) {
            $questionnaireCategory = QuestionnaireResultCategory::where([
                '1st_category_id' => $secondHighest->id,
                '2nd_category_id' => $firstHighest->id,
            ])->first();
        } elseif (!$questionnaireCategory) {
            $questionnaireCategory = QuestionnaireResultCategory::where([
                '1st_category_id' => $firstHighest->id,
            ])->first();
        }

        return [
            'result' => $result,
            // 'questionnaire_result_category_id' => $this->faker->numberBetween(1, 5),
            'questionnaire_result_category_id' => $questionnaireCategory ? $questionnaireCategory->id : null,
            '1st_category_id' => $firstHighest->id,
            '2nd_category_id' => $secondHighest ? $secondHighest->id : null,
        ];
    }
}
