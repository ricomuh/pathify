<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireAnswer extends Model
{
    protected $fillable = ['questionnaire_question_id', 'answer'];

    public function questionnaireQuestion()
    {
        return $this->belongsTo(QuestionnaireQuestion::class);
    }

    public function scores()
    {
        return $this->hasMany(QuestionnaireAnswerScore::class);
    }
}
