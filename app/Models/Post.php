<?php

namespace App\Models;

use App\Models\Jpo;
use App\Models\User;
use App\Models\PostImage;
use App\Models\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'type','image' ,'jpo_id', 'user_id'];


    public function jpo()
    {
        return $this->belongsTo(Jpo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



      public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
