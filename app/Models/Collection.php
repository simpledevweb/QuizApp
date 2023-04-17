<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function allowed_users()
    {
        return $this->hasMany(Allowed_user::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function results()
    {
        return $this->hasMany(Result::class);
    }
    protected $fillable = [
        'category_id',
        'user_id',
        'name',
        'description', 
        'code',
        'allowed_type',
    ];
}
