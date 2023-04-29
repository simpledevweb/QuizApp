<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
     //relationships
    protected $fillable = [
        'collection_id',
        'question_id',
        'user_id',
        'answer_id', 
        'is_correct',
    ];
    
    protected $casts = [
        'is_correct' => 'boolean'
    ];
}
