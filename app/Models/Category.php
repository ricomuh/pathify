<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['icon_image', 'name', 'slug', 'color', 'parent_id'];

    public $timestamps = false;

    private $colors = [
        '#FF0000',
        '#00FF00',
        '#0000FF',
        '#FFFF00',
        '#FF00FF',
        '#00FFFF',
        '#C0C0C0',
        '#808080',
        '#800000',
        '#808000',
        '#008000',
        '#800080',
        '#008080',
        '#000080',
        '#FFA07A',
        '#20B2AA',
        '#FF4500',
        '#FFD700',
        '#FF69B4',
        '#FF6347',
        '#FF7F50',
        '#FFA500',
        '#FF8C00',
        '#FF1493',
    ];

    // auto generate slug
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = str($model->name)->slug('-');

            // check if the color is empty
            if (empty($model->color)) {
                $model->color = $model->colors[array_rand($model->colors)];
            }
        });
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
