<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    //softddeletes  
     //relationships
    use SoftDeletes;
    public function collections():HasMany
    {
        return $this->hasMany(Collection::class);
    }
    protected $fillable = [
        'name',
    ];
}
