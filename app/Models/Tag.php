<?php

namespace App\Models;

use App\Models\Jpo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug'
    ];



       public function event():BelongsToMany
    {
        return $this->belongsToMany(Jpo::class);
    }
}
