<?php

use App\Models\Category;
use App\Models\QuestionnaireResultCategory;
use App\Models\User;
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
        Schema::create('questionnaire_results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class)->constrained();
            $table->json('result');
            $table->foreignIdFor(QuestionnaireResultCategory::class)->constrained();
            $table->foreignIdFor(Category::class, '1st_category_id')->constrained();
            $table->foreignIdFor(Category::class, '2nd_category_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaire_results');
    }
};
