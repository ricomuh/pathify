<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireQuestion extends Model
{
    protected $fillable = ['order', 'question'];

    public function answers()
    {
        return $this->hasMany(QuestionnaireAnswer::class);
    }

    public function scores()
    {
        return $this->hasManyThrough(QuestionnaireAnswerScore::class, QuestionnaireAnswer::class);
    }
}
