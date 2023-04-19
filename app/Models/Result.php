<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
     //relationships
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
    protected $fillable = [
        'collection_id',
        'question_id',
        'user_id',
        'answer_id', 
        'is_correct',
    ];
}
