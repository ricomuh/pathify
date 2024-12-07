<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorSocialLink extends Model
{
    /** @use HasFactory<\Database\Factories\MentorSocialLinkFactory> */
    use HasFactory;

    protected $fillable = [
        'mentor_detail_id',
        'social_link_id',
        'url',
    ];

    public function mentorDetail()
    {
        return $this->belongsTo(MentorDetail::class);
    }

    public function socialLink()
    {
        return $this->belongsTo(SocialLink::class);
    }
}
