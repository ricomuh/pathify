<?php

use App\Models\Category;
use App\Models\CourseCategory;
use App\Models\QuestionnaireAnswer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questionnaire_answer_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(QuestionnaireAnswer::class)->constrained();
            $table->integer('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaire_answer_scores');
    }
};
