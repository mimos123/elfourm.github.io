<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jpo extends Model
{
    use HasFactory;

    use HasFactory;

   protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'image',
        'address',
        'user_id',

    ];

    public function user()
{
    return $this->belongsTo(User::class)->where(function($query) {
        $query->where('role', 'resp')->orWhere('role', 'admin');
    });
}

      public function attendings()
    {
        return $this->hasMany(Attending::class);
    }

      public function tags()
{
    return $this->belongsToMany(Tag::class, 'event_tag');
}

     public function HasTag($tag)
    {
        return $this->tags->contains($tag);
    }

   public function users()
    {
        return $this->belongsToMany(User::class, 'attendees')->withPivot('status')->withTimestamps();
    }



 public function posts()
{
    return $this->hasMany(Post::class);
}


}
