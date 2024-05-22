<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Answer extends Model
{
    use HasFactory;

     protected $fillable = [
        'body', 'score', 'question_id', 'user_id', 'best_amswer'
    ];

    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function question()
    {
        return $this->belongsTo(Question::Class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::Class, 'votable');
    }
}
