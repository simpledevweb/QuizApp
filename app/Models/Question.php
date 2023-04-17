<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function results()
    {
        return $this->hasMany(Result::class);
    }
    protected $fillable = [
        'collection_id',
        'question',
        'correct_answers',
    ];
}