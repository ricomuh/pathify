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
    ];
}
