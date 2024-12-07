<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'profession',
        'profession_at',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
