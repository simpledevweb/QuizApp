<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function results()
    {
        return $this->hasMany(Result::class);
    }
    protected $fillable = [
        'question_id',
        'answer',
        'is_correct'
    ];
}
