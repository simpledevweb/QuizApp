<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
    protected $fillable = [
        'name',
    ];
}
