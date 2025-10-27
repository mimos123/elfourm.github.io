<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
         'role',
        'password',
        'profile_picture',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function events()
    {
        return $this->belongsToMany(Jpo::class, 'attendees')->withPivot('status')->withTimestamps();
    }

     public function posts()
    {
        return $this->hasMany(Post::class);
    }


  public function applications()
    {
        return $this->hasMany(Application::class);
    }


    protected static function booted()
    {
        static::creating(function ($user) {
            // Set default profile picture based on role
            if (!$user->profile_picture) {
                switch ($user->role) {
                    case 'admin':
                        $user->profile_picture = 'admin.jpg';
                        break;
                    case 'resp':
                        $user->profile_picture = 'resp.png';
                        break;
                    case 'company':
                        $user->profile_picture = 'company.png';
                        break;

                    // Add more cases as needed
                    default:
                        $user->profile_picture = 'user.png';
                        break;
                }
            }
        });
    }


}

