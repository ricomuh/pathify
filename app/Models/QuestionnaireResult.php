<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnaireResult extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionnaireResultFactory> */
    use HasFactory;

    public $fillable = ['user_id', 'result', 'questionnaire_result_category_id', '1st_category_id', '2nd_category_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(QuestionnaireResultCategory::class, 'questionnaire_result_category_id');
    }

    public function firstCategory()
    {
        return $this->belongsTo(Category::class, '1st_category_id');
    }

    public function secondCategory()
    {
        return $this->belongsTo(Category::class, '2nd_category_id');
    }
}
