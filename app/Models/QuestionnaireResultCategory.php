<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireResultCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'color',
        'icon',
        '1st_category_id',
        '2nd_category_id',
    ];

    public function firstCategory()
    {
        return $this->belongsTo(Category::class, '1st_category_id');
    }

    public function secondCategory()
    {
        return $this->belongsTo(Category::class, '2nd_category_id');
    }
}
