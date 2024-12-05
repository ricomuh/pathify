<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireAnswerScore extends Model
{
    protected $fillable = ['category_id', 'questionnaire_answer_id', 'score'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questionnaireAnswer()
    {
        return $this->belongsTo(QuestionnaireAnswer::class);
    }
}
