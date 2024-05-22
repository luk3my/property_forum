<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'body', 'viewCount', 'score', 'tags', 'user_id'
    ];

    protected $casts = [
        'tags' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::Class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::Class, 'votable');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
