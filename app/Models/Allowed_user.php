<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allowed_user extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
    protected $fillable = [
        'user_id',
        'collection_id'
    ];
}
