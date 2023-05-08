<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use HasFactory;
    use SoftDeletes;
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
