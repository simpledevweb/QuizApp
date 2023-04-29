<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'collections';
    protected $fillable = [
        'category_id',
        'user_id',
        'name',
        'description',
        'code',
        'allowed_type',
    ];
    //relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function allowed_users()
    {
        $this->belongsToMany(
            related: User::class,
            table: 'allowed_users',
        );
    }
    public function questions():HasMany
    {
        return $this->hasMany(Question::class)->with('answers');
    }
  

    public function scopeSearch(Builder $builder, $search)
    {
        $builder->where('name', 'like', "%{$search}%")
            ->OrWhere('description', 'like', "%{$search}%");
    }
}
